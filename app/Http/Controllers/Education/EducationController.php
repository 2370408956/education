<?php

namespace App\Http\Controllers\Education;

use App\Model\CateModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    //首页
    public function index(){
        return view('education..direction');
    }


    //分类管理
    public function cate(){
        return view('education.cate.cate');
    }

    //章节管理
    public function chapter(){
        return view('education.chapter.chapter');
    }

    //课程管理
    public function curriculum(){
        return view('education.curriculum.curriculum');
    }

    public function demo(){
        return view('education.demo');
    }

}
