<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
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
        dd($request->user);
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = '23213';
        return $data;
    }
}
