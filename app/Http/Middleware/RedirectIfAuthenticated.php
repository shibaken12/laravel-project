<?php

//ログイン後にどこにリダイレクトさせるかを記述するファイル
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
    //$next:無名関数のインスタンスが入った変数。処理結果をコントローラに渡す
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.items_index');
                }
                break;
            case 'user':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('user.index');
                }
                break;
        }
        //コントローラの前に実行したいため上記の処理後のここに書く
        //コントローラの後に実行したいときは、処理の前に書く
        return $next($request);
    }
}
