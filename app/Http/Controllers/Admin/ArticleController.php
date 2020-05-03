<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
class ArticleController extends BaseController
{
    /**
	 * 文章首页
    */
    public function index(){
    	return view('admin.article.index');
	}
	
	/**
	 * 表格展示
	 */
	public function show(Request $request){
		$limit = $request->limit?$request->limit:10;
		$page = $request->page?$request->page:1;
		$offset = ($request->page - 1) * $limit;
		
		$filterSos = $request->filterSos;
		
		if($filterSos){
			$sql = proSearchParam(json_decode($filterSos, true), "", true);
			if($sql){
				$tableSql = "select * from article where user_id = ? and".$sql."limit ?,?";
			}else{
				$tableSql = "select * from article where user_id = ? limit ?,?";
			}
		}else{
			$tableSql = "select * from article where user_id = ? limit ?,?";
		}
		$data = DB::select($tableSql,[$this->guard()->id(),$offset,$limit]);
		$count = Article::where('user_id', $this->guard()->id())->count();
		return layui_json(0,'success',$data,$count);
	}
	
	/**
	 * 表格展示
	 */
	public function infor(Request $request){
		Log::debug('测试log信息');
		Log::write('测试log信息');
		$res = Article::where('user_id',$this->guard()->id())->get()->toArray();
		$data['title'] = array_column($res, 'title');
		$data['address'] = array_column($res, 'num');
		$data['created_at'] = array_column($res, 'created_at');
		$data['updated_at'] = array_column($res, 'updated_at');
		return json_encode($data);
	}
	
	/**
	 * 文章添加页
	*/
	public function create(){
		return view('admin.article.append');
	}
	
	/**
	 * 文章添加
	*/
	public function store(ArticleRequest $articleRequest){
		$data = $articleRequest->except(['_token', 'file']);
		$data['user_id'] = $this->guard()->id();
		$res = Article::create($data);
		if($res){
			return layui_json();
		}
		return layui_json(416);
	}
	
	/**
	 * 文章删除
	 */
	public function destroy($id){
		$res = Article::query()->where('id',$id)->delete();
		// 恢复文章隔离
//		Article::withTrashed()
//			->where('id', 1)
//			->restore();
		if ($res){
			return layui_json(200,'删除成功');
		}
		return layui_json(201,'删除失败');
	}
}
