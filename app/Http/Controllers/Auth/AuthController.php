<?php

namespace App\Http\Controllers\Auth;

use App\Cuenta;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public $registerView = 'auth.registrar';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres'           => 'required|max:60',
            'apellido_paterno'  => 'required|max:60',
            'apellido_materno'  => 'required|max:60',
            'rut'               => 'required|cl_rut|max:12',
            'tipo'              => 'required|in:cliente,transportista,ambos',
            'email'             => 'required|email|max:255|unique:CUENTAS,CUE_EMAIL',
            'password'          => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Cuenta
     */
    protected function create(array $data)
    {
        return Cuenta::create([
            'CUE_NOMBRES'       => $data['nombres'],
            'CUE_APELL_PATERNO' => $data['apellido_paterno'],
            'CUE_APELL_MATERNO' => $data['apellido_materno'],
            'CUE_RUT'           => $data['rut'],
            'CUE_EMAIL'         => $data['email'],
            'CUE_TIPO'          => $data['tipo'],
            'CUE_PASSWORD'      => bcrypt($data['password']),
        ]);
    }

}
