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

Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('back','LoginController@Index');
    Route::post('register','LoginController@register');
});
\Illuminate\Support\Facades\Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
