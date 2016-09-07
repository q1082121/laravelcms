<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminMiddleware
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
        
        //检测用户是否登录
        if (Auth::check()) 
        {
            $user =Auth::user();
        }
        else
        {
            $guard="web";
            if (Auth::guard($guard)->guest()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->guest('/user/login');
                }
            }
        }
        
        return $next($request);
    }
}
