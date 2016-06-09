<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Laracasts\Flash\Flash;

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
        $infoCuenta = [
            'rut'=>Auth::user()->CUE_RUT,
            'nombres' => Auth::user()->CUE_NOMBRES,
            'apellido_paterno' => Auth::user()->CUE_APELL_PATERNO,
            'apellido_materno' => Auth::user()->CUE_APELL_MATERNO,
        ];
        return view('auth.edit')->with('infoCuenta',$infoCuenta);
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
        $infoCuenta = [
            'rut'=>$request['rut'],
            'nombres' => $request['nombres'],
            'apellido_paterno' => $request['apellido_paterno'],
            'apellido_materno' => $request['apellido_materno'],
        ];
        //return view('auth.edit')-with('infoCuenta',$infoCuenta);
        return redirect('edit')->with('infoCuenta',$infoCuenta);
    }

    public function editPassword(Request $request)
    {
        $this->validate($request,[
           'oldPassword' => 'required',
           'password' => 'required|confirmed|min:6'
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
            return redirect('edit');

        }
        else
        {
            Flash::error('Contraseña incorrecta');
            return redirect('edit');
        }
        /*
        $infoCuenta = [
            'rut'=>$request['rut'],
            'nombres' => $request['nombres'],
            'apellido_paterno' => $request['apellido_paterno'],
            'apellido_materno' => $request['apellido_materno'],
        ];
        //return view('auth.edit')-with('infoCuenta',$infoCuenta);
        return redirect('edit')->with('infoCuenta',$infoCuenta);
        */
    }

}
