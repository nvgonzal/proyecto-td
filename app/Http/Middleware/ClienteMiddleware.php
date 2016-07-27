<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ClienteMiddleware
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
        if (!Auth::check() || Auth::user()->CUE_TIPO == 'transportista') {
            abort(403);
        }
        return $next($request);
    }
}
