<?php

namespace App\Http\Controllers\Education;

use App\Model\CateModel;
use App\Model\CurrModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{
    //课程展示
    public function index($id=0){
        $cateid=$id ?? 0;
        $where= $cateid ? ['curriculum.cateid'=>$cateid,'curriculum.status'=>1] :['curriculum.status'=>1];

        $arr=CurrModel::where($where)
            ->join('category','curriculum.cateid','=','category.cateid')
            ->paginate(5);

        return view('education.curriculum.curriculum',['arr'=>$arr]);
    }

    //课程添加
    public function cAdd(){
        $cateinfo=CateModel::where('pid',0)->get();

        return view('education.curriculum.Add',['cateinfo'=>$cateinfo]);
    }

    //课程添加执行
    public function cAddDo (Request $request)
    {

        $arr=$request->input();
//        $topCate=$arr['topCate'];
        unset($arr['_token']);
        $arr['ctime']=time();
        $arr['utime']=time();

        $re=CurrModel::insert($arr);

        if($re){
            //添加课程之后，分类下的课程数量加一
            $re=CateModel::where('cateid',$arr['cateid'])->first();
            $re->courses=$re['courses']+1;
            $res=$re->save();

            return redirect('curriculum/index/'.$arr['cateid']);
        }

        return response('Internal Server Error',500);
    }


    //课程删除
    public function curriculumDel(Request $request){
        $cid=intval($request->input('cid',0));
        if(!$cid){
            return response('Forbidden',403);
        }

        $re=CurrModel::where('cid',$cid)->update(['status'=>2]);

        if($re){
            return response('OK',200);
        }

        return response('Internal Server Error',500);

    }
    //课程的批量删除
    public function curriculumDelMore (Request $request)
    {
        $cid=$request->cid;
        if(!$cid){
            return response('Forbidden',403);
        }
        $cidArr=explode(',',$cid);

        $re=CurrModel::whereIn('cid',$cidArr)->update(['status'=>2]);

        if($re){
            return response('OK',200);
        }

        return response('Internal Server Error',500);
    }


    //课程修改
    public function curriculumEdit($cid=0){
        $cid=intval($cid);

        if(!$cid){
            return response('Forbidden',403);
        }

        $cateinfo=CateModel::where('pid',0)->get();
        $cInfo=CurrModel::where('cid',$cid)->first();

        return view('education.curriculum.curriculumEdit',['cateinfo'=>$cateinfo,'cinfo'=>$cInfo]);
    }

    //课程修改执行
    public function curriculumEditDo (Request $request)
    {
        $arr=$request->input();
        if(!isset($arr['cid'])){
            return response('Forbidden',403);
        }
        unset($arr['_token']);
        $arr['status']=$arr['status'] ?? 2;

        $re=CurrModel::where('cid',$arr['cid'])->update($arr);
        if($re !== false){
            return redirect('/curriculum/index');
        }

        return response('Internal Server Error',500);
    }
}
