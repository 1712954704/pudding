<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabelController extends BaseController
{
    /**
	 * 标签首页
    */
    public function index(){
		return view('admin.label.index');
	}
	
	/**
	 * 标签展示
	 */
	public function show(Request $request){
		$limit = $request->limit?$request->limit:10;
		$page = $request->page?$request->page:1;
		$offset = ($request->page - 1) * $limit;
		
		$filterSos = $request->filterSos;
		
		if($filterSos){
			$sql = proSearchParam(json_decode($filterSos, true), "", true);
			if($sql){
				$tableSql = "select * from label where user_id = ? and".$sql."limit ?,?";
			}else{
				$tableSql = "select * from label where user_id = ? limit ?,?";
			}
		}else{
			$tableSql = "select * from label where user_id = ? limit ?,?";
		}
		$data = DB::select($tableSql,[$this->guard()->id(),$offset,$limit]);
		$count = Label::where('user_id', $this->guard()->id())->count();
		return layui_json(0,'success',$data,$count);
	}
	
	/**
	 * 标签展示
	 */
	public function infor(Request $request){
		$res = Label::query()->where('user_id',$this->guard()->id())->get()->toArray();
		$data['title'] = array_column($res, 'title');
		return json_encode($data);
	}
	
	/**
	 * 标签添加页
	 */
	public function create(){
		return view('admin.label.append');
	}
	
	/**
	 * 标签添加
	 */
	public function store(ArticleRequest $articleRequest){
		$data = $articleRequest->except(['_token', 'file']);
		$data['user_id'] = $this->guard()->id();
		$res = Label::create($data);
		if($res){
			return layui_json();
		}
		return layui_json(416);
	}
	
	/**
	 * 标签删除
	 */
	public function destroy($id){
		$res = Label::query()->where('id',$id)->delete();
		if ($res){
			return layui_json(200,'删除成功');
		}
		return layui_json(201,'删除失败');
	}
}
