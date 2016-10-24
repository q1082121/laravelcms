<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :单点登录
*******************************************/
namespace App\Http\Middleware;
use Closure;
class SsoMiddleware
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
        return $next($request);
    }
}
