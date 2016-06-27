<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EnvioController extends Controller
{
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
            . $direccion . "&key=AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc";
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
            . $direccion . "&key=AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc";
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
                break;
        }
        $exito = $envio->save();
        if ($exito) {
            Flash::success('Envio ingresado con exito');
            return redirect('/cliente/envio/create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
