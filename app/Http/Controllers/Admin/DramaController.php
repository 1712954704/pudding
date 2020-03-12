<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DramaController extends BaseController
{
    /**
	 * 番剧首页
    */
    public function index(){
    	return view('admin.drama.index');
	}
	
	/**
	 * 视频添加
	*/
	public function  create(){
		return view('admin.drama.append');
	}
	
	/**
	 * 表格添加
	 */
	public function store(Request $request){
		$data = $request->except(['_token', 'file']);
		$data['user_id'] = $this->guard()->id();
		$res = Video::create($data);
		if($res){
			return layui_json();
		}
		return layui_json(416);
	}
}
