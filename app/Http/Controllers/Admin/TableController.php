<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * 表格首页
    */
    public function index(){
        return view('admin.table.index');
    }
}
