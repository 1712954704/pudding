<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthUsers
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
        //当 auth 中间件判定某个用户未认证，会返回一个 JSON 401 响应，或者，如果不是 Ajax 请求的话，将用户重定向到 login 命名路由（也就是登录页面）。
        if (Auth::guard('user')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/back');
            }
        }
        return $next($request);

//        if(Auth::check() == false){
//            return Redirect::guest('/admin/back');
//        }
//        return $next($request);
    }
}
