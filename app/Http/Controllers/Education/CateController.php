<?php

namespace App\Http\Controllers\Education;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CateModel;

class CateController extends Controller
{
    public function index(){

        $arr=$this->getinfo();
        $info=$this->disponse($arr);

//        echo "<pre>";
//        var_dump($info);
//        die;
        return view('education.cate.cate',['info'=>$info]);
    }

    //查询的数据存入缓存
    function getinfo(){
//        $cateinfo=Cache::get('cateinfo');
//        if($cateinfo){
//            $arr=unserialize($cateinfo);
//        }else{
//            $arr=CateModel::where('status',1)->get()->toarray();
//            Cache::set('cateinfo',serialize($arr));
//        }
        $arr=CateModel::where('status',1)->get()->toarray();
        return $arr;
    }

    function getSecoed(){
        $info=$this->getinfo();
        $arr=[];
        foreach ($info as $k=>$v){
            if($v['pid']==0){
                $arr[]=$v;
            }
        }
        return $arr;
    }

    
    //递归处理数据
    public function disponse ($arr,$pid=0)
    {
        $info=[];
        foreach ($arr as $k=>$v){
            if($v['pid']==$pid){
                $son=$this->disponse($arr,$v['cateid']);
                $v['son']=$son;
                $info[]=$v;
            }
        }
        return $info;
    }

    //根据顶级id找到子分类
    public function getSonInfo (Request $request)
    {
        $cateid=$request->input('cateid',0);

        if(!$cateid){
            return response('Forbidden',403);
        }

        $re=CateModel::where('pid',$cateid)->get();
        if($re){
            return json_encode($re->toarray());
        }
        return response('Internal Server Error',500);
    }

    //分类添加
    public function cateAdd(){
        $arr=CateModel::where(['status'=>1,'pid'=>0])->get();
        return view('education.cate.cateAdd',['arr'=>$arr]);
    }

    //添加执行
    public function cateAddDo(Request $request){
        $type=$request->type;
        $catemodel=new CateModel();
        $request->status ==1?$catemodel->status=1:$catemodel->status=2;
        $catemodel->catname=$request->catname;
        $catemodel->ctime=time();
        $catemodel->utime=time();

        $type==1?$catemodel->pid=0 : $catemodel->pid=$request->cateid;

        $re=$catemodel->save();

        if($re){
            return redirect('cate/index');
        }
        return response('Internal Server Error',500);


    }

    //分类修改
    public function cateEdit($id=0){
        $id=intval($id,0);
        if(!$id){
            return response('Unauthorized',401);
        }
        $arr=CateModel::where('cateid',$id)->first();
        if(!$arr){
            return response('Internal Server Error',500);
        }
        $info=$this->getSecoed();

        return view('education.cate.cateEdit',['arr'=>$arr,'info'=>$info]);
    }

    //修改执行
    public function cateEditDo (Request $request)
    {
        $arr=$request->input();
        $arr['status']=$arr['status'] ?? 2;
        unset($arr['_token']);
        $re=(new CateModel)->where('cateid',$arr['cateid'])->update($arr);
        if($re){
            return redirect('cate/index');
        }

        return view('education.cate.cateAdd',['arr'=>$arr]);
        var_dump($re);
        Cache::flush();
    }

    //删除
    public function cateDel (Request $request)
    {
        $cateid=$request->input('cateid','');
        $cateid=intval($cateid);
        if(!$cateid){
            return response('Forbidden',403);
        }

        $re=CateModel::where('cateid',$cateid)->update(['status'=>2]);
        if($re){
            return response('ok',200);
        }

        return response('Internal Server Error',500);
    }
}
