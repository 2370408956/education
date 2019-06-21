<?php

namespace App\Http\Middleware;

use Closure;

class Sign
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
        $notcestr = isset($_GET['notcestr']) ? trim($_GET['notcestr']) :'';
        $timestamp = isset($_GET['timestamp']) ? trim($_GET['timestamp']) :'';
        $sign = isset($_GET['sign']) ? trim($_GET['sign']) :'';
        if($notcestr && $timestamp && $sign){
//            if(time()-$timestamp > 100){
//                return Response()->json('你应该早点来的呀',401);
//            }
            $token = env('SIGN_TOKEN');
            $info=$request->post();
            $arr=[$notcestr,$timestamp,$token];
            if($info){
                unset($info['_token']);
                $arr['info']=json_encode($info);
            }
            sort($arr,SORT_STRING);
            $checksign = sha1(implode($arr));
            if($checksign != $sign){
                return Response()->json('你好像没有这个权利',401);
            }
        }else{
            return Response()->json('没有这个权利',401);
        }
        return $next($request);
    }
}
