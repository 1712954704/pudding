<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::namespace("api")->group(function(){
    Route::get("test","TestController@test");      // 测试api
});

// 微信相关
//Route::prefix('wx')->namespace('api\wx')->group(function(){
Route::group(['namespace'=>'api\wx','prefix'=>'wx'],function(){
    Route::get('deploy',"DeployController@index");  // 微信
});
