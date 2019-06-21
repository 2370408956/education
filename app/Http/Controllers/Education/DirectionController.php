<?php

namespace App\Http\Controllers\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectionController extends Controller
{
    public function index(){

    }

    public function addIndex(){

        return view('education.direction.directionAdd');
    }
}
