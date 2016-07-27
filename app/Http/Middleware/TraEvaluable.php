<?php

namespace App\Http\Middleware;

use App\Cuenta;
use App\Envio;
use Closure;
use Illuminate\Support\Facades\Auth;

class TraEvaluable
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
        if (Envio::find($request->id)->TRA_ID != Cuenta::find(Auth::user()->CUE_ID)->transportista->TRA_ID) {
            abort(403);
        }
        return $next($request);
    }
}
