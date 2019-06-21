<?php

namespace App\Http\Controllers\API;

use App\Model\UserModel;
use App\Tools\Http;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wea=$request->wea;
        $info=Redis::get($wea);
        if($info){
            return json_decode($info,true);
        }else{
            $appkey=env('NOWAPIKEY');
            $sign=env('NOWAPISIGN');
            $url="http://api.k780.com/?app=weather.today&weaid=$wea&appkey=$appkey&sign=$sign&format=json";
            $re=Http::httpGet($url);
            Redis::set($wea,$re);
            return json_decode($re,true);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username=isset($request->username)? $request->username:'';
        $pwd=isset($request->password)? $request->password:'';
        if(!$username || !$pwd){
            return response('Unauthorized',401);
        }
        $re=UserModel::where('username',$username)->first();
        if($re->password==decrypt($pwd)){
            $data=[
                'userid'=>$re,
                'exp'=>time()+7200
            ];
            $jwt=JWT::encode($data,env('JWT_TOKEN'));
            session(['jwt'=>$jwt]);

            return response($jwt,200);
        }
        return 2;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
