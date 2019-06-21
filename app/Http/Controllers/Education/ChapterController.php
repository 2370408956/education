<?php

namespace App\Http\Controllers\Education;

use App\Model\ChapterModel;
use App\Model\CurrModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\phpSdkMaster\qiniu;
use Illuminate\Support\Facades\Storage;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class ChapterController extends Controller
{
    public function index(Request $request){
        $where=[
            'chapter.status'=>1,
            'pid'=>0
        ];
        $arr=ChapterModel::where($where)
            ->join('curriculum','curriculum.cid','=','chapter.cid')
            ->paginate(5);

        return view('education.chapter.chapter',['arr'=>$arr]);
    }


    //章节添加
    public function chapterAdd(){
        $arr=CurrModel::where('status',1)->get(['cid','cname']);

        return view('education.chapter.chapterAdd',['arr'=>$arr]);
    }

    //获取章节数据
    public function getChapter (Request $request){
        $cid=$request->cid;
        $where=[
            'cid'=>$cid,
            'pid'=>0,
            'status'=>1
        ];
        $chapterArr= ChapterModel::where($where)->get();

        return json_encode($chapterArr);
    }

    //添加执行
    public function chapterAddDo (Request $request)
    {
        $arr=$request->input();
        unset($arr['_token']);
        $arr['ctime']=time();
        $arr['utime']=time();
        $re=ChapterModel::insert($arr);
        if($re){
            if($arr['type']==1){
                $res=CurrModel::where('cid',$arr['cid'])->first(['cid','chapters']);
                $res->chapters=$res['chapters']+1;
                $res->save();
            }
            return response('OK',200);
        }

        return response('Internal Server Error',500);
    }

    //切片上传文件
    public function uploadFile (Request $request)
    {
        $chunks=$_POST['chunks'];
        $name=$_POST['name'];
        $path='/video/'.$name;
        if($chunks==1){
            $re=file_put_contents($path,file_get_contents($_FILES['file']['tmp_name']));
            return $path;
        }else{
            $chunk=$_POST['chunk'];
            if($chunk == $chunks-1){
                file_put_contents('./video/tmp/'.$chunk.'.tmp',file_get_contents($_FILES['file']['tmp_name']));
                for($i=0;$i<$chunks;$i++){
                    file_put_contents('./video/'.$name,file_get_contents('./video/tmp/'.$i.'.tmp'),FILE_APPEND );
                    unlink('./video/tmp/'.$i.'.tmp');
                }
                return $path;
            }else{
                file_put_contents('./video/tmp/'.$chunk.'.tmp',file_get_contents($_FILES['file']['tmp_name']));
            }
        }


    }


    //小节添加
    public function knobble (Request $request,$id=0)
    {
        $id=intval($id);
        $where=[
            'chapter.status'=>1,
        ];
        $id ? $where['pid']=$id:$where['pid']=0;
        $arr=ChapterModel::where($where)->get();
        $chaptername=ChapterModel::where('chapterid',$id)->value('chaptername');


        return view('education.chapter.knobble',['arr'=>$arr,'chaptername'=>$chaptername]);
    }
    //小节列表
    public function knobbleList($id){

        $id=intval($id);
        if(!$id){
            return response('Forbidden',403);
        }

        $chapterInfo=ChapterModel::where(['chapterid'=>$id,'status'=>1])->first();
        $chaptername=ChapterModel::where('chapterid',$chapterInfo['pid'])->value('chaptername');

        return view('education.chapter.knobbleList',['chapterInfo'=>$chapterInfo,'chaptername'=>$chaptername]);
    }

    //小节修改

    public function knobbleEdit (Request $request)
    {

        return view('education.chapter.knobbleEdit');
    }


    //章节修改页面
    public function chapterEdit($id=0){
        $id=intval($id);
        if(!$id){
            return response('Forbidden',403);
        }

        $arr=CurrModel::where('status',1)->get(['cid','cname']);
        $chapterInfo=ChapterModel::where(['chapterid'=>$id,'status'=>1])->first();
        $info=[];
        if($chapterInfo['type']=='节'){
            $info=ChapterModel::where(['cid'=>$chapterInfo['cid'],'pid'=>0])->get();
        }
        return view('education.chapter.chapterEdit',['arr'=>$arr,'chapterInfo'=>$chapterInfo,'info'=>$info]);
    }

    //章节修改执行
    public function chapterEditDo(Request $request){
        $arr=$request->except('_token');
        if(!$arr['videourl']){
            unset($arr['videourl']);
        }
        $re=ChapterModel::where('chapterid',$arr['chapterid'])->update($arr);

        if($re !==false){
            return response('OK',200);
        }

        return response('Internal Server Error',500);
    }


    //章节删除
    public function chapterDel(Request $request){
        $chapterid=intval($request->chapterid);
        if(!$chapterid){
            return response('Forbidden',403);
        }
        $count=ChapterModel::where(['pid'=>$chapterid,'status'=>1])->count();

//        if($count>0){
//            return response('Internal Server Error',500);
//        }
        $re=ChapterModel::where('chapterid',$chapterid)->update(['status'=>2]);

        if($re){
            return response('OK',200);
        }

        return response('Internal Server Error',500);
    }


    //demo
    public function demoindex ()
    {
        return view('demo1');
    }

    public function demo(Request $request){
        new qiniu();
        $accessKey = 'rLUCoZS8e65aw1JC9W68tovo4a5WEIM59HDtmLHy';
        $secretKey = 'tMKHkORfowcPs6J-ADIzRhHKlbEoXcnVqwBO1NAH';
//        $auth=new Auth($accessKey,$secretKey);
//        $bucket='chuan';
//        $token=$auth->uploadToken($bucket);
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'chuan';
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        return $token;
        die;
        $uploadMgr=new UploadManager();
        $file = $request->file('file');
        $tmpPath  = $file->getRealPath();    // 获取图片在本地绝对路径
        //获取后缀名
        $ext      = $file->getClientOriginalExtension();
        $fileName = time() . rand(1000, 10000) . '.' . $ext;
        list($ret, $error) = $uploadMgr->putFile($token, $fileName, $tmpPath);
        if ($error !== null) {
            dd($error);
        } else {
            dd($ret);
        }
    }

    public function qiniu ()
    {
        echo 1;die;
    }
}
