<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TableController extends BaseController
{
    /**
     * 表格首页
    */
    public function index(){
        return view('admin.table.index');
    }

    /**
     * 表格添加
     */
    public function create(){
        return view('admin.table.append');
    }

    /**
     * 表格添加
     */
    public function store(TableRequest $tableRequest){
        $data = $tableRequest->except(['_token', 'file']);
        $data['user_id'] = $this->guard()->id();
        $res = Table::create($data);
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
		
		if($filterSos){
			$sql = proSearchParam(json_decode($filterSos, true), "", true);
			if($sql){
				$tableSql = "select * from tables where user_id = ? and".$sql."limit ?,?";
			}else{
				$tableSql = "select * from tables where user_id = ? limit ?,?";
			}
		}else{
			$tableSql = "select * from tables where user_id = ? limit ?,?";
		}
//		DB::connection()->enableQueryLog();#开启执行日志
		$data = DB::select($tableSql,[$this->guard()->id(),$offset,$limit]);
        $count = Table::where('user_id', $this->guard()->id())->count();

//		dd(DB::getQueryLog());
		return layui_json(0,'success',$data,$count);
    }
	
	/**
	 * 表格展示
	 */
	public function infor(Request $request){
		$res = Table::where('user_id',$this->guard()->id())->get()->toArray();
//		$data['title'] = array_unique(array_column($res, 'title'));
		$data['title'] = array_column($res, 'title');
		$data['num'] = array_column($res, 'num');
		$data['detail'] = array_column($res, 'detail');
		$data['created_at'] = array_column($res, 'created_at');
		$data['updated_at'] = array_column($res, 'updated_at');
		return json_encode($data);
	}

}
