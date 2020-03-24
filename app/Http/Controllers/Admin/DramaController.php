<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DramaController extends BaseController
{
    /**
	 * 视频首页
    */
    public function index(){
		return view('admin.drama.index');
	}
	
	/**
	 * 视频添加页
	*/
	public function  create(){
		return view('admin.drama.append');
	}
	
	/**
	 * 视频添加
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
	
	
	/**
	 * 表格展示
	 */
	public function show(Request $request){
		$limit = $request->limit?$request->limit:10;
		$page = $request->page?$request->page:1;
		$offset = ($request->page - 1) * $limit;
		
		$filterSos = $request->filterSos;

//		$filed['tag_name'] = "F";
//		$sql = proSearchParam(json_decode($_POST['filterSos'], true), "", true);
//		$sql = proSearchParam(json_decode($filterSos, true), "", true);
		
		if($filterSos){
			$sql = proSearchParam(json_decode($filterSos, true), "", true);
			if($sql){
				$tableSql = "select * from video where user_id = ? and".$sql."limit ?,?";
			}else{
				$tableSql = "select * from video where user_id = ? limit ?,?";
			}
		}else{
			$tableSql = "select * from video where user_id = ? limit ?,?";
		}
		$data = DB::select($tableSql,[$this->guard()->id(),$offset,$limit]);
		$count = Video::where('user_id', $this->guard()->id())->count();
		return layui_json(0,'success',$data,$count);
	}
	
	/**
	 * 表格展示
	 */
	public function infor(Request $request){
		$res = Video::where('user_id',$this->guard()->id())->get()->toArray();
		$data['title'] = array_column($res, 'title');
		$data['address'] = array_column($res, 'num');
		$data['created_at'] = array_column($res, 'created_at');
		$data['updated_at'] = array_column($res, 'updated_at');
		return json_encode($data);
	}
	
	/**
	 *视频播放
	*/
	public function play(Request $request){
		return view('admin.drama.play',["address" => $request->address]);
	}
	
	/**
	 * 视频删除
	*/
	public function destroy($id){
		$data = Video::query()->find($id);
		$file = pathinfo($data->address);
		$res = Storage::disk('drama')->delete('drama/'.$file['basename']);
		if ($res){
			return layui_json(200,'删除成功');
		}
		return layui_json(201,'删除失败');
	}
}
