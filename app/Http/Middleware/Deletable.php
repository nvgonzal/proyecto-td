<?php

namespace App\Http\Middleware;

use Closure;
use App\Envio;

class Deletable
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
        if (Envio::find($request->id)->ENV_ESTADO != 'Activo') {
            abort(403);
        }
        return $next($request);
    }
}
