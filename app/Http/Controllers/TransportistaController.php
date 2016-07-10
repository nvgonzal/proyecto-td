<?php

namespace App\Http\Controllers;

use Gmaps;
use App\Envio;
use Flash;
use App\Cuenta;
use Exception;
use URL;
use Auth;
use App\Http\Requests;

class TransportistaController extends Controller
{
    private $apiKey = 'AIzaSyD8hh18OThd8mkDRnSttJMoM28hU_40Jzc';

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
}
