<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;

class CheckLogin
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
        $method=$request->method();
        if($method=='GET'){
            $jwttoken=isset($_SERVER['HTTP_AUTHORIZATION']) ?$_SERVER['HTTP_AUTHORIZATION']:'';
            if(!$jwttoken){
                return response('请登录',401);
            }
            if($jwttoken){
                $re=JWT::decode($jwttoken,env('JWT_TOKEN'));
                if(!$re){
                    return response('请登录',401);
                }
            }else{
                return response('请登录',401);
            }
        }




        return $next($request);
    }
}
