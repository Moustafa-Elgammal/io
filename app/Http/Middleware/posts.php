<?php

namespace App\Http\Middleware;

use Closure;

class posts
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
        // TODO:: posts Middleware Rules
        return $next($request);
    }
}
