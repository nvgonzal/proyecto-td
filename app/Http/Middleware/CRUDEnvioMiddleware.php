<?php

namespace App\Http\Middleware;

use Closure;
use App\Cuenta;
use App\Envio;
use Auth;
use URL;

class CRUDEnvioMiddleware
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
        if (Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID != Envio::find($request->id)->CLI_ID) {
            abort(401);
        }
        return $next($request);
    }
}
