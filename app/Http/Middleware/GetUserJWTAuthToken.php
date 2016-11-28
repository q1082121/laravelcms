<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetUserJWTAuthToken
{
    /**
     * 身份验证.
     *
     * Author : LeePeng
     * email: lp@kuhui.com.cn
     * Date: 15/12/29
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'errcode' => 400004,
                    'errmsg' => 'user not found'
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'errcode' => 400001,
                'errmsg' => 'token expired'
            ], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json([
                'errcode' => 400003,
                'errmsg' => 'token invalid'
            ], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json([
                'errcode' => 400002,
                'errmsg' => 'token absent'
            ], $e->getStatusCode());

        }
        return $next($request);
    }
}
