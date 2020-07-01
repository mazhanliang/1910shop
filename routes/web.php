<?php

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
Route::get('/info', function () {
    phpinfo();
});
Route::get('test',"TestController@hello");
Route::get('goods/index',"Goods\GoodsController@index");
Route::get('redis',"TestController@redis");


Route::get('user/reg',"Goods\GoodsController@reg"); //注册前台
Route::post('user/regad',"Goods\GoodsController@regad"); //注册后台

Route::get('user/login',"Goods\GoodsController@login"); //前台登录
Route::post('user/loginadd',"Goods\GoodsController@loginadd"); //后台登录

Route::get('user/conter',"Goods\GoodsController@conter"); //个人中心




//Api
Route::post('api/user/reg',"Api\Usercontroller@regad"); //注册后台
Route::post('api/user/login',"Api\Usercontroller@loginadd"); //登录后台
Route::get('api/user/center',"Api\Usercontroller@center")->middleware('checkpri'); //个人中心




//验签
Route::get('api/sign',"Api\SignController@sign1");
Route::post('api/signadd',"Api\SignController@sign2");


//加密
Route::get('enctypt',"Api\SignController@encrypt1");
//非对称加密
Route::get('enctypt2',"Api\SignController@encrypt2");

Route::get('sendB',"Api\TestController@sendB");

Route::get('sign',"Api\TestController@sign");