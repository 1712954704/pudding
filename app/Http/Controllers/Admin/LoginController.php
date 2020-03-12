<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    /**
     * 登录页
    */
    public function index(){
        return view("admin.login.index");
    }


    /**
     * 登录
    */
    public function register(Request $request){
        $username = $request->user;
        $password = $request->pwd;
//		$pwd = Hash::make('123123');  // password加密方式
//		dd($pwd);
        // 验证用户名登录方式
        $userlLogin = $this->guard()->attempt(
            ['name' => $username, 'password' => $password],true
        );
        if($userlLogin){
            return layui_json();
        }
        return layui_json(201,'用户名或密码错误');
    }

    /**
     * 重写验证时使用的用户名字段.
     */
    public function username()
    {
        return 'name';
    }

    /**
     * 后台首页
    */
    public function entire(){
        return view("admin.entire.index");
    }
}
