<?php

namespace App\Http\Middleware;

use App\Cuenta;
use App\Envio;
use Closure;
use Illuminate\Support\Facades\Auth;

class Takable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cuenta = Cuenta::find(Auth::user()->CUE_ID);
        if ($cuenta->CUE_TIPO == 'transportista' || ($cuenta->CUE_TIPO == 'ambos' &&
                $cuenta->cliente->CLI_ID != Envio::find($request->id)->CLI_ID)
        ) {
            return $next($request);
        }
        abort(403);
    }
}
