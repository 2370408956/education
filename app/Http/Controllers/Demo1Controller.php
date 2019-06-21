<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Demo1Controller extends Controller
{
    public function index()
    {


        return view('demo1.index');
    }

    public function test()
    {
        echo '你好';
    }
}
