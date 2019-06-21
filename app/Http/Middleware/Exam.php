<?php

namespace App\Http\Middleware;

use Closure;

class Exam
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
        $str=isset($_GET['str'])?$_GET['str']:'';
        $time=isset($_GET['time'])?$_GET['time']:'';
        $sign=isset($_GET['sign'])?$_GET['sign']:'';
        if(!$str || !$time || !$sign){
            return response('Unauthorized',401);
        }
//        if((time()-$time)>20){
//            return response('过期',401);
//        }
        $token=env('SIGN_TOKEN');
        $arr=[$str,$time,$token];
        $method=$request->method();

        if($method=='POST'){
            $info=$request->post();
            unset($info['_token']);
            if(isset($info['password'])){
                $info['password']=decrypt($info['password']);
            }
            $arr['info']=json_encode($info);
        }
        $checksign=sha1(implode($arr));
        if($checksign != $sign){
            return response('非法来源',401);
        }

        return $next($request);
    }
}
