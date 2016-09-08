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
        $guard="admin";
        if (Auth::guard($guard)->check()) 
        {
            
        }
        else
        {
            return redirect()->guest('/user/login');
        }
        
        return $next($request);
    }
}
