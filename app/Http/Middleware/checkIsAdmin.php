<?php

namespace App\Http\Middleware;

use Closure;

class checkIsAdmin
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
        if ($request->user()->role == 'admin') {
            return $next($request);
        }
        else {
            abort(403);
        }
    }
}
