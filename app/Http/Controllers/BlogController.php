<?php

namespace App\Http\Controllers;

use App\Http\Resources\blog;
use App\Model\BlogModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $re=Auth::attempt(['username'=>'2370408956@qq.com','password'=>123]);
        var_dump($re);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $request->validate([
//            'username' => 'required|unique:user|max:255',
//            'password' => 'required',
//        ]);
        $data=[
            'username'=>$request->username,
            'password'=>$request->password
        ];

//        $user=self::create($data);
//        var_dump($user);die;
        $user=Auth::user();
        var_dump($user);
        die;
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response(['data'=>$success],200);
//        return UserModel::insert($request);





//        $blog_title=isset($_POST['blog_title'])? trim($_POST['blog_title']) :'';
//        $blog_content=isset($_POST['blog_content'])? trim($_POST['blog_content']) :'';
//
//        if(!$blog_content || !$blog_title){
//            return Response()->json(['message'=>'Precondition Failed'],412);
//        }
//
//        $data=['blog_title'=>$blog_title,'blog_content'=>$blog_content];
//        $re=BlogModel::insert($data);
//
//        if($re){
//            return Response()->json(['data'=>$data],200);
//        }
//        return Response()->json(['message'=>'internal server error'],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 111;die;

        echo JWTAuth::parseToken()->refresh();
        die;
        $where=$id ? ['blog_id'=>trim($id)] :'';

//        $re=BlogModel::where($where)->first();
        return Blog::collection(BlogModel::all());
        var_dump($re);die;
        if($re){
            return Response()->json(['data'=>$re->toarray()],200);
        }
        return Response()->json(['message'=>'internal server error'],500);
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
        $blog_title=isset($request->blog_title) ? $request->blog_title :'';
        $blog_content=isset($request->blog_content) ? $request->blog_content :'';

        if(!$blog_title || !$blog_content){
            return Response()->json(['message'=>'Precondition Failed'],412);
        }
        $re=BlogModel::where(['blog_id'=>$id])->update(['blog_title'=>$blog_title,'blog_content'=>$blog_content]);

        if($re){
            return Response()->json(['message'=>'ok'],200);
        }
        return Response()->json(['message'=>'internal server error'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where=$id ? ['blog_id'=>$id] :'';

        $re=BlogModel::where($where)->delete();

        if($re){
            return Response()->json(['message'=>'delete ok'],200);
        }
        return Response()->json(['message'=>'internal server error'],500);
    }
}
