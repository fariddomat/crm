<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (auth()->user()->hasRole(['admin'])) {
                return redirect(RouteServiceProvider::ADMIN);
            }
            elseif(auth()->user()->hasRole(['back_office'])) {
                return redirect(RouteServiceProvider::BACK_OFFICE);
            }
            elseif(auth()->user()->hasRole(['supervisor'])) {
                return redirect(RouteServiceProvider::SUPERVISOR);
            }
            return redirect(RouteServiceProvider::agent);
        }

        return $next($request);
    }
}
