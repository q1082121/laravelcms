<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :后台登录状态中间件
*******************************************/
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
        //检测用户是否登录 自定义验证登录方法
        /*$guard="admin";
        if (Auth::guard($guard)->check()) 
        {
            
        }
        else
        {
            return redirect()->guest('/user/login');
        }
        */
        
        $guard="admin";
        if (Auth::guard($guard)->guest()) 
        {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/user/login');
            }
        }
        
        return $next($request);
    }
}
