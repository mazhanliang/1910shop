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


Route::any('user/reg',"Goods\GoodsController@reg"); //注册前台
Route::any('user/regad',"Goods\GoodsController@regad"); //注册后台

Route::any('user/login',"Goods\GoodsController@login"); //前台登录
Route::any('user/loginadd',"Goods\GoodsController@loginadd"); //后台登录