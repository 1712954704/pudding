<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FictionController extends BaseController
{
    /**
    小说首页
    */
    public function  index(){
//        $this->guard()->logout();
        return view('admin.fiction.index');
    }
}
