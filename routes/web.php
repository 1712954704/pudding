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

Route::get('/canvas',function(){
    return view('/index/canvas');
});

Route::get('/particle',function (){
    return view('/index/particle');
});

//后台

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
    Route::get('back','LoginController@Index');                 // 后台登录页
    Route::post('register','LoginController@register');         // 后台登录验证
    Route::group(['middleware'=>'AuthUsers'],function(){
        Route::get('entire','LoginController@entire');          // 后台首页
        Route::get('fiction','FictionController@index');        // 后台小说首页
//        Route::get('table','TableController@index');            // 后台表格首页
//        Route::get('append','TableController@add');              // 后台表格添加
        Route::resource('table', 'TableController');            //后台表格资源路由
    });
});


Route::get('/home', 'HomeController@index')->name('home');
