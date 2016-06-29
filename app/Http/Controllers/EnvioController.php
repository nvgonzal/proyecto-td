<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Envio;
use Illuminate\Http\Request;

use App\Http\Requests;
use Gmaps;
use URL;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class EnvioController extends Controller
{
    private $apiKey = 'AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('envio.verhistorial')->with('envios',Envio::where('CLI_ID',Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID)->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('envio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required',
            'direccion_recogida' => 'required|max:255',
            'direccion_destino' => 'required|max:255',
            'fecha_limite' => 'required|date',
            'peso' => 'required|min:0',
            'volumen' => 'required|min:0',
            'tipo' => 'required',
            'tipo_camion' => 'required|min:5|max:50'
        ]);
        $cliente = Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID;
        $envio = new Envio();
        $envio->setAttribute('TRA_ID', null);
        $envio->setAttribute('CLI_ID', $cliente);
        $envio->setAttribute('ENV_PESO_CARGA', $request['peso']);
        $envio->setAttribute('ENV_FECHA_LIMITE', $request['fecha_limite']);
        $envio->setAttribute('ENV_VOLUMEN', $request['volumen']);
        $envio->setAttribute('ENV_TIPO_CAMION', $request['tipo_camion']);
        $envio->setAttribute('ENV_TIPO', $request['tipo']);
        $envio->setAttribute('ENV_ESTADO', 'true');
        $envio->setAttribute('ENV_DESCRIPCION', $request['descripcion']);
        $envio->setAttribute('ENV_VALORACION_CLI', 0);
        $envio->setAttribute('ENV_VALORACION_TRA', 0);
        $direccion = $request['direccion_recogida'];
        $direccion = str_replace(' ', '+', $direccion);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address="
            . $direccion . "&key=" . $this->apiKey;
        $recogida = file_get_contents($url);
        $objetoRecogida = json_decode($recogida);
        switch ($objetoRecogida->status) {
            case 'ZERO_RESULTS':
                Flash::error("Direccion de recogida no dio ningun resultado");
                return redirect('/cliente/envio/create')->withInput($request->toArray());
                break;
            case 'OK':
                $envio->setAttribute('ENV_DIRECCION_RECOGIDA', $request['direccion_recogida']);
                $lat = $objetoRecogida->results[0]->geometry->location->lat;
                $lng = $objetoRecogida->results[0]->geometry->location->lng;
                $coor = $lat . ' , ' . $lng;
                $envio->setAttribute('ENV_COORDENADAS_RECOGIDA', $coor);
                break;
        }
        //-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/
        $direccion = $request['direccion_destino'];
        $direccion = str_replace(' ', '+', $direccion);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address="
            . $direccion . "&key=" . $this->apiKey;
        $recogida = file_get_contents($url);//Conecta con API de google para trasformar direccion en coordenadas
        $objetoDestino = json_decode($recogida);//trasforma el JSON a un arreglo
        switch ($objetoDestino->status) {
            case 'ZERO_RESULTS':
                Flash::error("Direccion de destino no dio ningun resultado");
                return redirect('/cliente/envio/create')->withInput($request->toArray());
                break;
            case 'OK':
                $envio->setAttribute('ENV_DIRECCION_DESTINO', $request['direccion_destino']);
                $lat = $objetoDestino->results[0]->geometry->location->lat;
                $lng = $objetoDestino->results[0]->geometry->location->lng;
                $coor = $lat . ' , ' . $lng;
                $envio->setAttribute('ENV_COORDENADAS_DESTINO', $coor);
                break;
        }
        $exito = $envio->save();
        if ($exito) {
            Flash::success('Envio ingresado con exito');
            return $this->show($envio->ENV_ID);
        } else {
            Flash::error('No pudo ingresar envio');
            return redirect('/cliente/envio/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $envio = Envio::find($id);

        $config = array();
        $config['zoom'] = 'auto';
        $config['map_height'] = '540px';
        $config['apiKey'] = $this->apiKey;

        Gmaps::initialize($config);
        $marcadorRecogida = array();
        $marcadorRecogida['position'] = $envio->ENV_COORDENADAS_RECOGIDA;
        $marcadorRecogida['icon'] = 'http://localhost/proyecto_td/public/img/package-for-delivery.png';
        Gmaps::add_marker($marcadorRecogida);

        $marcadorDestino = array();
        $marcadorDestino['position'] = $envio->ENV_COORDENADAS_DESTINO;
        $marcadorDestino['icon'] = 'http://localhost/proyecto_td/public/img/flag.png';
        Gmaps::add_marker($marcadorDestino);

        $map = Gmaps::create_map();
        return view('envio.show')->with('envio', $envio)->with('map', $map);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $envio = Envio::find($id);

        return view('envio.edit')->with('envio',$envio)->with('envId',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'descripcion' => 'required',
            'direccion_recogida' => 'required|max:255',
            'direccion_destino' => 'required|max:255',
            'fecha_limite' => 'required|date',
            'peso' => 'required|min:0',
            'volumen' => 'required|min:0',
            'tipo' => 'required',
            'tipo_camion' => 'required|min:5|max:50'
        ]);
        $cliente = Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID;
        $envio = Envio::find($id);
        $envio->ENV_PESO_CARGA = $request['peso'];
        $envio->ENV_FECHA_LIMITE= $request['fecha_limite'];
        $envio->ENV_VOLUMEN= $request['volumen'];
        $envio->ENV_TIPO_CAMION= $request['tipo_camion'];
        $envio->ENV_TIPO= $request['tipo'];
        $envio->ENV_DESCRIPCION = $request['descripcion'];
        $direccion = $request['direccion_recogida'];
        $direccion = str_replace(' ', '+', $direccion);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address="
            . $direccion . "&key=AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc";
        $recogida = file_get_contents($url);
        $objetoRecogida = json_decode($recogida);
        switch ($objetoRecogida->status) {
            case 'ZERO_RESULTS':
                Flash::error("Direccion de recogida no dio ningun resultado");
                return redirect('/cliente/envio/edit/'.$id)->withInput($request->toArray());
                break;
            case 'OK':
                $envio->ENV_DIRECCION_RECOGIDA= $request['direccion_recogida'];
                $lat = $objetoRecogida->results[0]->geometry->location->lat;
                $lng = $objetoRecogida->results[0]->geometry->location->lng;
                $coor = $lat . ' , ' . $lng;
                $envio->ENV_COORDENADAS_RECOGIDA = $coor;
                break;
        }
        return view ('envio.edit')->with($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verEnvios()
    {
        $envios = Envio::where('ENV_ESTADO', true)->get();
        $config = array();
        $config['center'] = 'auto';
        $config['zoom'] = '13';
        $config['apiKey'] = $this->apiKey;
        $config['map_height'] = '540px';

        Gmaps::initialize($config);

        foreach ($envios as $envio) {
            $marcador = array();
            $marcador['position'] = $envio->ENV_COORDENADAS_RECOGIDA;
            $marcador['icon'] = 'http://localhost/proyecto_td/public/img/package-for-delivery.png';
            $marcador['infowindow_content'] = '<a href="' . URL::to('cliente/envio/' . $envio->ENV_ID)
                . '">' . $envio->ENV_DESCRIPCION . '</a>';
            Gmaps::add_marker($marcador);
        }
        $map = Gmaps::create_map();
        //dd($map);
        return view('envio/verEnvios')->with('map', $map);
    }
}
