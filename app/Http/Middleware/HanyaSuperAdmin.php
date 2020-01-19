<?php

namespace App\Http\Middleware;

use Closure;

class HanyaSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->role == 'superadmin')
            return $next($request);
        abort(503);
    }
}
