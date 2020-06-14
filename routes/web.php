<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('loginout','LoginController@loginout');         // 后台登出
    Route::group(['middleware'=>'AuthUsers'],function(){
        Route::get('entire','LoginController@entire');          // 后台首页
        Route::get('fiction','FictionController@index');        // 后台小说首页
//        Route::get('table','TableController@index');            // 后台表格首页
//        Route::get('append','TableController@add');              // 后台表格添加
        Route::resource('table', 'TableController');              //后台表格资源路由
        Route::post('table/{id}','TableController@infor');			// soultable重载数据表格
        Route::resource('drama', 'DramaController');              //后台番剧资源路由
        Route::post('drama/{id}', 'DramaController@infor');       //soultable重载数据番剧
        Route::get('play', 'DramaController@play');               //視頻播放
        Route::resource('article','ArticleController');			// 文章资源路由
        Route::post('article/{id}', 'ArticleController@infor');     //soultable重载数据文章
        Route::resource('label','LabelController');			  // 标签资源路由
        Route::post('label/{id}', 'LabelController@infor');     //soultable重载数据标签
        Route::resource('convert', 'ConvertController');     		// word转txt测试
        Route::post('analysis', 'ConvertController@analysis');    // word上传并解析
    });
});


Route::group(['namespace'=>'Tool','prefix'=>'tool'],function(){
    Route::post('uploadVideo', 'UploadController@video');			// 视频上传
    Route::post('uploadRichImg', 'UploadController@richImage');	// 图片上传
    Route::post('delFile', 'UploadController@delFile');	       // 文件删除
});
