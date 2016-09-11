<?php

namespace App\Http\Controllers;

use Gmaps;
use App\Envio;
use Flash;
use App\Cuenta;
use Exception;
use Mail;
use URL;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\Cliente;

class TransportistaController extends Controller
{
    private $apiKey = 'AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc';

    public function verEnvios()
    {
        $envios = Envio::activo()->get();
        $config = array();
        $config['center'] = 'auto';
        $config['zoom'] = '13';
        $config['apiKey'] = $this->apiKey;
        $config['map_height'] = '540px';
        Gmaps::initialize($config);

        foreach ($envios as $envio) {
            $marcador = array();
            $marcador['position'] = $envio->ENV_COORDENADAS_RECOGIDA;
            $marcador['icon'] = URL::asset('img/package-for-delivery.png');
            $marcador['infowindow_content'] = '<a href="' . URL::to('cliente/envio/' . $envio->ENV_ID)
                . '">' . $envio->ENV_DESCRIPCION . '</a>';
            Gmaps::add_marker($marcador);
        }
        $map = Gmaps::create_map();
        //dd($map);
        return view('envio/verEnvios')->with('map', $map);
    }

    public function tomarEnvio($id)
    {
        
        try {
            $envio = Envio::find($id);
            $tra = Cuenta::find(Auth::user()->CUE_ID)->transportista;
            $envio->solicitudes()->attach($tra->TRA_ID);
            Flash::success('Envio tomado.');
            $info = [
                'Nombre' => Auth::user()->CUE_NOMBRE_COMPLETO,
                'Correo' => Auth::user()->CUE_EMAIL,
                'Telefono' => Auth::user()->CUE_TELEFONO,
                'Id_Envio' => $id,
                'Id_Tra' => Auth::user()->CUE_ID
            ];
            Mail::send('email.viewTransportistaToCliente',$info,function ($msj) use ($id){
                $msj->subject('Han tomado uno de tus envios');
                $msj->to(Cuenta::find(Cliente::find(Envio::find($id)->CLI_ID)->CUE_ID)->CUE_EMAIL);
            });
            return redirect(URL::previous());
        } catch (Exception $e) {
            Flash::error('Ya has tomado este envio!');
            return redirect(URL::previous());
        }
    }

    public function cancelarSolicitud($id)
    {
        $envio = Envio::find($id);
        $tra = Cuenta::find(Auth::user()->CUE_ID)->transportista;
        $envio->solicitudes()->detach($tra->TRA_ID);
        Flash::success('Solicitud cancelada');
        return redirect(URL::previous());
    }

    public function verEnviosTomados()
    {
        $tra = Cuenta::find(Auth::user()->CUE_ID)->transportista;
        $envios = $tra->solicitudes;
        //dd($envios);
        return view('envio.enviosTomados')->with('envios', $envios);
    }

    public function evaluar($id)
    {
        $envio = Envio::find($id);
        return view('envio.evaluarCli')->with('envio', $envio);
    }

    public function registrarEvaluacion(Request $request, $id)
    {
        $this->validate($request, [
            'evaluacion' => 'required|numeric|between:1,5'
        ]);
        $envio = Envio::find($id);
        $envio->ENV_VALORACION_CLI = $request['evaluacion'];
        $envio->save();
        DB::statement('exec SP_RECALCULAR_VALORACION_DEL_CLIENTE ?', [$envio->CLI_ID]);
        Flash::success('Evaluacion registrada');
        return redirect('cliente/envio/' . $envio->ENV_ID);
    }

    public function enviosFinalizados()
    {
        $envios = DB::select("select * from ENVIOS WHERE TRA_ID = ? AND ENV_ESTADO = 'Finalizado'",
            [Cuenta::find(Auth::user()->CUE_ID)->transportista->TRA_ID]);
        return view('envio.finalizados')->with('envios', $envios);
    }
}
