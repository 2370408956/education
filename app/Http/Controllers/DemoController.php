<?php

namespace App\Http\Controllers;

use App\Tools\demo;
use App\Tools\Http;
use App\Tools\Rsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{

    public function demo($num)
    {
        $arr=[];
        for ($i=0;$i<$num;$i++){
            if($i==0 || $i==1){
                $arr[]=1;
            }else{
                $arr[]= $arr[$i-1]+$arr[$i-2];
            }
        }
        echo implode("\r",$arr);
    }


    public function demo1()
    {
        echo 1111;die;
        $a=array(1,2,3,4,5,6,7);
        $b=array(
            array(1,2),
            array(3,4),
            array(5,6),
            array(7),
        );
        $arr=[];
        $num=count($a);
        foreach ($a as $k=>$v){
            if($k%2==1){
                $arr[]=[$a[$k-1],$a[$k]];
            }
            if($k==$num-1){
                $arr[]=[$a[$k]];
            }
        }
        echo '<pre>';
        var_dump($arr);
    }

    public function index()
    {
//        $re=Http::httpGet('https://www.baidu.com');
//        var_dump($re);
//        die;
//        $str=Rsa::encrypt('1234');
//        echo $str;
//        echo Rsa::decrypt($str);
//        die;
        return view('index');
    }

    public function indexList()
    {
        return view('indexList');
    }

    public function add(Request $request)
    {
        $file=$request->file('file');
        var_dump($file);
        die;
        $name=$request->name;
        $idnum=$request->IDnum;
        $re=DB::table('demo')->insert(['username'=>$name,'idnum'=>$idnum]);
        var_dump($re);
    }

    public function applyforList()
    {
        return view('applyforList');
    }
    
    public function applyfor(Request $request)
    {
        $re=DB::table('demo')->where(['status'=>1])->get()->toArray();

        return $re;

    }
    public function applyfor1(Request $request)
    {
        $re=DB::table('demo')->where('status','!=',1)->get()->toArray();
        foreach ($re as $k=>$v){
            if($v->status==2){
                $re[$k]->status='已通过';
            }else{
                $re[$k]->status='未通过';
            }
        }
        return $re;

    }

    public function operation(Request $request)
    {
        $id=$request->input('id');
        $status=$request->input('status');
        $content=$request->input('content');
        $status=$status=='ok'?2:3;
        $app_key=$app_secret='';
        if($status==2){
            $app_key=$this->randStr(20);
            $app_secret=$this->randStr(60);
        }
        $re=DB::table('demo')->where(['id'=>$id])->update(['status'=>$status,'reason'=>$content,'app_key'=>$app_key,'app_secret'=>$app_secret]);

        return response($re,200);
    }

    public function randStr($len=20)
    {
        $str='0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $token='';
        for ($i=0;$i<$len;$i++){
            $k=rand(0,strlen($str)-1);
            $token.=$str[$k];
        }

        return $token;
    }

    public function test()
    {
        echo 111;
    }












    public function addSign(Request $request)
    {
        $info=$request->all();
        $notcestr='wqertyvc';
        $timestamp=1559120138;
        $token = env('SIGN_TOKEN');
        $arr=[$notcestr,$timestamp,$token];
        sort($arr,SORT_STRING);


        if($info){
            unset($info['_token']);
            $arr['info']=json_encode($info);
        }
        $checksign = sha1(implode($arr));
        $arr=['notcestr'=>$notcestr,'timestamp'=>$timestamp,'sign'=>$checksign];
        $sign=http_build_query($arr);
        return $sign;
    }


    public function loginIndex ()
    {
//        return view('loginIndex');
        return view('demo');
    }

    public function datacrypt(Request $request){
        $password=encrypt($request->password);

        return $password;
    }

    public function getsign(Request $request)
    {
        $str='qaazwsxcderfvbgtyhnmjukiolp1234567890';
        $str=str_shuffle($str);
        $str=substr($str,4,6);
        $time=time();
        $token=env('SIGN_TOKEN');
        $arr=[$str,$time,$token];
        $method =$request->method();

        if($method=='POST'){
            $info=$request->post();
            unset($info['_token']);
            if(isset($info['password'])){
                $info['password']=decrypt($info['password']);
            }
            $arr['info']=json_encode($info);
        }
        $sign=sha1(implode($arr));


        $param=['str'=>$str,'time'=>$time,'sign'=>$sign];
        return http_build_query($param);
    }

    public function querywea ()
    {
        return view('querywea');
    }
}
