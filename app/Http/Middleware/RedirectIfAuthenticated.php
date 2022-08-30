<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

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
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;
            case 'user':
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }
        // if (Auth::guard($guard)->check() && $guard === 'user') {
        //     return redirect(RouteServiceProvider::HOME);
        // } elseif (Auth::guard($guard)->check() && $guard === 'admin') {
        //     return redirect(RouteServiceProvider::ADMIN_HOME);
        // }
        return $next($request);
    }
}
