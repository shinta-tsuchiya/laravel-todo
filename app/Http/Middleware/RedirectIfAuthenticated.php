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

    /**
     * このミドルウェアはユーザーが認証済みの場合は、コントローラーなどの
     * 後続のプログラムに処理を渡さずにリダイレクトしている
     * リダイレクト先がデフォルトでは '/home' と記述されているが、
     * 今回はアプリケーションにはそのようなURLを持つページは存在しないので
     * ホームページのURL / に書き換える
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
