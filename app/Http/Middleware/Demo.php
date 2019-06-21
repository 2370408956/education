<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Demo
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
//        $app_key=$request->input('app_key');
//        $app_secret=$request->input('app_secret');
//        if(!$app_secret || !$app_key){
//            return response('Unauthorized',401);
//        }else{
//            $arr=Redis::get($app_key);
//            if($arr){
//                $arr=unserialize($arr);
//                if($arr['app_secret']==$app_secret){
//                    if($arr['num']>=20){
//                        return response('many request',403);
//                    }else{
//                        $arr['num']=$arr['num']+1;
//                        $arr=serialize($arr);
//                        Redis::set($app_key,$arr);
//                    }
//                }else{
//                    return response('Unauthorized',401);
//                }
//            }else{
//                $re=DB::table('demo')->where(['app_key'=>$app_key])->first();
//                if(!$re || $re->app_secret!=$app_secret){
//                    return response('Unauthorized',401);
//                }
//                $arr=[
//                    'app_secret'=>$app_secret,
//                    'num'=>1
//                ];
//                $arr=serialize($arr);
//                Redis::set($app_key,$arr);
//            }
//
//        }

        return $next($request);
    }
}
