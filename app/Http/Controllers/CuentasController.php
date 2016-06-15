<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Cliente;
use App\Trasportista;

class CuentasController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // obtener id del usuario que usa la funcion Auth::user()->CUE_ID;

        if(Auth::check()){
            return view('auth.edit')->with('infoCuenta',$this->infoCuenta());
        }else{
            return redirect('/');
        }
    }

    /** function to get the info of the user
     * @return array with the info of the user
     */
    public function infoCuenta(){
        $infoCuenta = [
            'rut'=>Auth::user()->CUE_RUT,
            'nombres' => Auth::user()->CUE_NOMBRES,
            'apellido_paterno' => Auth::user()->CUE_APELL_PATERNO,
            'apellido_materno' => Auth::user()->CUE_APELL_MATERNO,
            'telefono' => Auth::user()->CUE_TELEFONO,
            'tipo' => Auth::user()->CUE_TIPO
        ];
        return $infoCuenta;
    }
    /**
     * Edit the personal information of an user
     */
    public function editInformacionPersonal(Request $request){
        $this->validate($request,[
            'rut'=>'required|max:12|cl_rut',
            'nombres' => 'required|max:60',
            'apellido_paterno' => 'required|max:60',
            'apellido_materno'   => 'required|max:60'
        ]);
        $id = Auth::user()->CUE_ID;
        $cuenta = Cuenta::find($id);
        $cuenta->CUE_RUT = $request['rut'];
        $cuenta->CUE_NOMBRES = $request['nombres'];
        $cuenta->CUE_APELL_PATERNO = $request['apellido_paterno'];
        $cuenta->CUE_APELL_MATERNO = $request['apellido_materno'];
        $exito=$cuenta->save();
        if($exito)
        {
            Flash::success('Los datos fueron actualizados con exito');
        }
        else
        {
            Flash::error('Los datos no pudieron ser actualizados');
        }
        //return view('auth.edit')-with('infoCuenta',$infoCuenta);
        return redirect('edit')->with('infoCuenta',$this->infoCuenta());
    }

    public function editPassword(Request $request)
    {
        $this->validate($request,[
           'oldPassword' => 'required',
           'password' => 'required|confirmed|min:6',
           'password_confirmation' => 'required'
        ]);
        if(Hash::check($request['oldPassword'],Auth::user()->CUE_PASSWORD))
        {
            $id = Auth::user()->CUE_ID;
            $cuenta = Cuenta::find($id);
            $cuenta->CUE_PASSWORD = Hash::make($request['password']);
            $exito=$cuenta->save();
            if($exito)
            {
                Flash::success('La contraseña fue actualizada con exito');

            }
            else
            {
                Flash::error('Contraseña no pudo ser actualizada');
            }


        }
        else
        {
            Flash::error('Contraseña incorrecta');
        }
        return redirect('edit')->with('infoCuenta',$this->infoCuenta());

    }
    public function editInformacionCuenta(Request $request){
        $this->validate($request,[
            'telefono' => 'required|min:6',
            'tipo' => 'required|in:cliente,transportista,ambos'
        ]);
        $id = Auth::user()->CUE_ID;
        $cuenta = Cuenta::find($id);
        $cuenta->CUE_TELEFONO = $request['telefono'];
        $oldType = Auth::user()->CUE_TIPO;
        $cuenta->CUE_TIPO = $request['tipo'];
        $exito=$cuenta->save();
        switch($oldType){
            case 'cliente':
                if ($cuenta->cliente != null) {
                    $cuenta->cliente->delete();
                }
                break;
            case 'transportista':
                if ($cuenta->trasportista != null) {
                    $cuenta->trasportista->delete();
                }
                break;
            case 'ambos':
                if ($cuenta->cliente != null) {
                    $cuenta->cliente->delete();
                }
                if ($cuenta->trasportista != null) {
                    $cuenta->trasportista->delete();
                }
                break;

        }
        $tCuenta = $cuenta->getAttribute('CUE_TIPO');
        switch ($tCuenta) {
            case 'cliente':
                $cliente = new Cliente();
                $cliente->setAttribute('CUE_ID', $cuenta->getAttribute('CUE_ID'));
                $cliente->setAttribute('CLI_VALORACION', '0');
                $cliente->save();
                break;
            case 'trasportista':
                $trasnportista = new Trasportista();
                $trasnportista->setAttribute('CUE_ID', $cuenta->getAttribute('CUE_ID'));
                $trasnportista->setAttribute('TRA_VALORACION', '0');
                $trasnportista->save();
                break;
            case 'ambos':
                $cliente = new Cliente();
                $cliente->setAttribute('CUE_ID', $cuenta->getAttribute('CUE_ID'));
                $cliente->setAttribute('CLI_VALORACION', '0');
                $cliente->save();
                $trasnportista = new Trasportista();
                $trasnportista->setAttribute('CUE_ID', $cuenta->getAttribute('CUE_ID'));
                $trasnportista->setAttribute('TRA_VALORACION', '0');
                $trasnportista->save();
                break;
        }
        if($exito)
        {
            Flash::success('Los datos fueron actualizados con exito');
        }
        else
        {
            Flash::error('Los datos no pudieron ser actualizados');
        }
        //return view('auth.edit')-with('infoCuenta',$infoCuenta);
        return redirect('edit')->with('infoCuenta',$this->infoCuenta());
    }

}
