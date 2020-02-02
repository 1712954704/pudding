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

Route::namespace('Api')->group(function () {
    Route::get('face', 'IndexController@face');                         // 测试Facebook
    Route::get('google', 'GoogleControler@google');                     // 测试Google广告分析接口
    Route::get('faceBook', 'FaceBookController@faceBook');              // 测试Facebook广告分析接口
});