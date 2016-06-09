<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Flash;
use App\Cliente;
use App\Cuenta;
use App\Trasportista;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

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

    protected $username = 'CUE_EMAIL';
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
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'deleteForm', 'logoutAndDelete']]);
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
            'rut' => 'required|cl_rut|max:12|unique:CUENTAS,CUE_RUT',
            'tipo'              => 'required|in:cliente,transportista,ambos',
            'email'             => 'required|email|max:255|unique:CUENTAS,CUE_EMAIL',
            'password'          => 'required|min:6|confirmed',
            'telefono' => 'required|min:6|max:30'
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
        $cuenta = new Cuenta();
        $cuenta->setAttribute('CUE_EMAIL', $data['email']);
        $cuenta->setAttribute('CUE_NOMBRES', $data['nombres']);
        $cuenta->setAttribute('CUE_APELL_PATERNO', $data['apellido_paterno']);
        $cuenta->setAttribute('CUE_APELL_MATERNO', $data['apellido_materno']);
        $cuenta->setAttribute('CUE_RUT', $data['rut']);
        $cuenta->setAttribute('CUE_TIPO', $data['tipo']);
        $cuenta->setAttribute('CUE_PASSWORD', Hash::make($data['password']));
        $cuenta->setAttribute('CUE_TELOFONO', $data['telefono']);
        $cuenta->save();
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
        return $cuenta;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['CUE_EMAIL' => $request['email'], 'password' => $request['password']], $request['remember'])) {
            return redirect()->intended('/');
        } else {
            Flash::error('Email o contraseña no coinciden');
            return redirect()->to('/login');
        }

    }

    /**
     * Muestra el formulario para confirmar eliminacion de cuenta
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteForm()
    {
        if (Auth::check()) {
            return view('auth.delete');
        } else {
            return redirect('/');
        }
    }

    /**
     * Cierra sesion y elimina la cuenta
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutAndDelete(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'password' => 'required|confirmed'
            ]);

            $id = Auth::user()->CUE_ID;
            $cuenta = Cuenta::find($id);
            if (Hash::check($request['password'], $cuenta->CUE_PASSWORD)) {
                Auth::guard($this->getGuard())->logout();
                if ($cuenta->trasportista != null) {
                    $cuenta->trasportista->delete();
                }
                if ($cuenta->cliente != null) {
                    $cuenta->cliente->delete();
                }
                $cuenta->delete();
                return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
            } else {
                Flash::error('Contraseña incorrecta');
                return redirect('logout/delete');
            }
        } else {
            return redirect('/');
        }

    }
}
