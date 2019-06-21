<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function (){
    Route::get('index',"DemoController@index");
    Route::post('upload',"DemoController@upload");
});

Route::prefix('demo')->group(function(){
//    Route::any('demo/{id}',"DemoController@demo");
    Route::any('demo1',"DemoController@demo1");
    Route::any('index',"DemoController@index");
    Route::any('addSign',"DemoController@addSign");
    Route::any('add',"DemoController@add");
    Route::any('applyforList',"DemoController@applyforList");
    Route::any('applyfor',"DemoController@applyfor");
    Route::any('operation',"DemoController@operation");
    Route::any('indexList',"DemoController@indexList");
    Route::any('applyfor1',"DemoController@applyfor1");
    Route::any('test',"DemoController@test")->middleware('demo');
    Route::any('loginindex',"DemoController@loginIndex");
    Route::any('getsign',"DemoController@getsign");
    Route::any('datacrypt',"DemoController@datacrypt");
    Route::any('querywea',"DemoController@querywea");
    Route::any('demo',"DemoController@loginIndex");
});


Route::prefix('demo1')->group(function (){
    Route::any('index','Demo1Controller@index');
    Route::any('test','Demo1Controller@test')->middleware('sign');
});


Route::any('getImg',function (){
    $path=public_path('images/20190604/');
    $dh=opendir($path);
    $img=[];
    while(($file=readdir($dh))!==false){
        if($file!='.' && $file !='..'){
            $img[]= $file;
        }
    }
    return json_encode($img);
});

Route::any('demo',function (){
    die;
    $arr='';
    $arr($_GET);
    var_dump($arr);
    die;
    echo '<pre>';
    var_dump(Request::capture());
    die;
    $url='https://www.jsdaima.com/Upload/1486617283/Luckdraw.js';
    $re=file_get_contents($url);

    file_put_contents('js/demo.js',$re);
});

Route::any('money',function (){
    $total=10;//红包总金额
    $num=10;// 分成10个红包，支持10人随机领取
    $min=0.01;//每个人最少能收到0.01元
    $arr=[];
    for ($i=1;$i<$num;$i++)
    {
        $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限
        $arr[]=$safe_total;
    //    echo $min.'<br>';
    //    echo (($safe_total*100)).'<br>';
        $money=mt_rand($min*100,$safe_total*100)/100;
        $total=$total-$money;
        echo '第'.$i.'个红包：'.$money.' 分，余额：'.$total.' 分 ';
        echo "<br>";
    }

    echo '第'.$num.'个红包：'.$total.' 分，余额：0 分';

});

Route::prefix('education')->group(function(){
    Route::any('index',"Education\\EducationController@index");
    Route::any('direction',"Education\\EducationController@direction");
    Route::any('cate',"Education\\EducationController@cate");
    Route::any('chapter',"Education\\EducationController@chapter");
//    Route::any('curriculum',"Education\\EducationController@curriculum");
    Route::any('video',"Education\\EducationController@video");
});

Route::prefix('direction')->group(function(){
    Route::any('add',"Education\\DirectionController@addIndex");
});
//分类
Route::prefix('cate')->group(function(){
    Route::any('add',"Education\\CateController@cateAdd");
    Route::any('index',"Education\\CateController@index");
    Route::any('addDo',"Education\\CateController@cateAddDo");
    Route::any('edit/{id?}',"Education\\CateController@cateEdit");
    Route::any('editDo/{id?}',"Education\\CateController@cateEditDo");
    Route::any('del',"Education\\CateController@cateDel");
    Route::any('getSonInfo',"Education\\CateController@getSonInfo");
});
//课程
Route::prefix('curriculum')->group(function(){
    Route::any('index/{cateid?}',"Education\\CurriculumController@index");
    Route::any('add',"Education\\CurriculumController@cAdd");
    Route::any('addDo',"Education\\CurriculumController@cAddDo");
    Route::any('edit/{id?}',"Education\\CurriculumController@curriculumEdit");
    Route::any('editDo',"Education\\CurriculumController@curriculumEditDo");
    Route::any('del',"Education\\CurriculumController@curriculumDel");
    Route::any('delMore',"Education\\CurriculumController@curriculumDelMore");
});
//章节
Route::prefix('chapter')->group(function(){
    Route::any('index',"Education\\ChapterController@index");
    Route::any('add',"Education\\ChapterController@chapterAdd");
    Route::any('addDo',"Education\\ChapterController@chapterAddDo");
    Route::any('edit/{id?}',"Education\\ChapterController@chapterEdit");
    Route::any('editDo',"Education\\ChapterController@chapterEditDo");
    Route::any('del',"Education\\ChapterController@chapterDel");
    Route::any('getchapter',"Education\\ChapterController@getChapter");
    //节
    Route::any('knobble/{id?}',"Education\\ChapterController@knobble");
    Route::any('knobbleList/{id}',"Education\\ChapterController@knobbleList");
    Route::any('knobbleEdit',"Education\\ChapterController@knobbleEdit");
    //demo
    Route::any('uploadfile',"Education\\ChapterController@uploadFile");
    Route::any('demoindex',"Education\\ChapterController@demoindex");
    Route::any('demo',"Education\\ChapterController@demo");
    Route::any('qiniu',"Education\\ChapterController@qiniu");
});

//用户
Route::prefix('user')->group(function(){
    Route::any('index',"Education\\UserController@index");
    Route::any('add',"Education\\UserController@userAdd");
    Route::any('addDo',"Education\\UserController@addDo");
    Route::any('edit/{id?}',"Education\\UserController@userEdit");
    Route::any('editDo',"Education\\UserController@userEditDo");
    Route::any('del/{id?}',"Education\\UserController@userDel");
    Route::any('delMore',"Education\\UserController@userDelMore");
});

Route::prefix('demo')->group(function(){
    Route::any('index',"Education\\EducationController@demo");
});




