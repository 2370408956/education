<?php

namespace App\Http\Controllers\Education;

use App\Model\UserModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $userinfo=UserModel::where('status',1)->paginate(1);

        return view('education.user.userIndex',['info'=>$userinfo]);
    }

    //用户添加页面
    public function userAdd(){
        return view('education.user.userAdd');
    }
    //添加执行页面
    public function addDo (Request $request)
    {
        $arr=[
            'username'=>$request->username,
            'password'=>$request->password,
            'mobile'=>$request->mobile,
            'profile'=>$request->intro??'',
            'ctime'=>time(),
            'utime'=>time(),
            'status'=>1
        ];

        $file=$request->file('file');
        if($file->isValid()){
            //获取文件的后缀名
            $ext=$file->getClientOriginalExtension();
            //获取文件的绝对路径
            $path=$file->getRealPath();
            //给文件生成一个唯一的名字
            $filename=substr(time(),-1).rand(1111,9999).".".$ext;
            //上传文件
            $re=Storage::disk('public')->put($filename,file_get_contents($path));
            $arr['avatar']=$filename;

            $re=UserModel::insert($arr);
            return response(['path'=>$filename],200);
        }else{
            return response('Internal Server Error',500);
        }
    }

    //用户修改
    public function userEdit ($id=0)
    {
        $id=intval($id);
        if(!$id){
            return response('Forbidden',403);
        }
        $userinfo=UserModel::where('uid',$id)->first();

        if(!$userinfo){
            return response('Forbidden',403);
        }

        return view('education.user.userEdit',['userinfo'=>$userinfo]);
    }

    //用户修改执行
    public function userEditDo (Request $request)
    {
        $uid=intval($request->uid);
        if(!$uid){
            return response('Forbidden',403);
        }
        $userinfo=UserModel::where('uid',$uid)->first();

        if(!$userinfo){
            return response('Forbidden',403);
        }
        $arr=[
            'username'=>$request->username,
            'mobile'=>$request->mobile,
            'profile'=>$request->profile??'',
            'utime'=>time(),
        ];
        $file=$request->file('file');
        if($file){
            if($file->isValid()){
                //获取文件的后缀名
                $ext=$file->getClientOriginalExtension();
                //获取文件的绝对路径
                $path=$file->getRealPath();
                //给文件生成一个唯一的名字
                $filename=substr(time(),-1).rand(1111,9999).".".$ext;
                //上传文件
                $re=Storage::disk('public')->put($filename,file_get_contents($path));
                $userinfo->avatar=$filename;
            }
        }
        $userinfo->username=$request->username;
        $userinfo->mobile=$request->mobile;
        $userinfo->profile=$request->profile??'';
        $userinfo->utime=time();
        $re=$userinfo->save();


        if($re !==false){
            return response('OK',200);
        }
        return response('Internal Server Error',500);
    }

    //删除
    public function userDel (Request $request)
    {
        $id=$request->uid;
        $id=intval($id);
        if(!$id){
            return response('Forbidden',403);
        }

        $re=UserModel::where('uid',$id)->update(['status'=>2]);

        if($re){
            return response('OK',200);
        }

        return response('Internal Server Error',500);
//        return redirect('user/')
    }

    //删除多个
    public function userDelMore (Request $request)
    {
        $uid=$request->uid;
        if(!$uid){
            return response('Forbidden',403);
        }
        $uidArr=explode(',',$uid);

        $re=UserModel::whereIn('uid',$uidArr)->update(['status'=>2]);

        if($re){
            return response('OK',200);
        }

        return response('Internal Server Error',500);
    }
}
