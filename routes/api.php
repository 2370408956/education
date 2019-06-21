<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::resource('blog','BlogController',['except' => ['create', 'edit']]);
//
//Route::resource('tasks', 'TaskController', ['except' => ['create', 'edit']]);

Route::resource('exam', 'API\ExamController');
Route::resource('axios', 'API\AxiosController');

//Route::resource('/demo','API\\DemoController',['except' => ['create', 'edit']])->middleware('checklogin');
//Route::resource('/upload','API\\UploadController',['except' => ['create', 'edit']]);
//
//Route::post('login', 'API\PassportController@login');
//Route::post('register', 'API\PassportController@register');
//
//Route::post('get-details', 'API\PassportController@login');

