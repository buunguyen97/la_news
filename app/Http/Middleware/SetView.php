<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SetView extends Middleware
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
        View::share('current_user', Auth::user());
        return $next($request);
    }
}
