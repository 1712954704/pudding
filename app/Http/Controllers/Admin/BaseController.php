<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * 指定user守卫
    */
    protected function guard()
    {
        return auth()->guard('user');
    }
}
