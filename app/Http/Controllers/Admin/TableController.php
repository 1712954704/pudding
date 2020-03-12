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
		
//		$filed['tag_name'] = "F";
//		$sql = proSearchParam(json_decode($_POST['filterSos'], true), "", true);
//		$sql = proSearchParam(json_decode($filterSos, true), "", true);
	
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

//		dd($data);
//		dd(DB::getQueryLog());
//
		return layui_json(0,'success',$data,$count);
	
	
//		$res['data'] = Table::where('user_id',$this->guard()->id())->offset($offset)->limit($limit)->get()->toArray();
//        $res['count'] = Table::where('user_id', $this->guard()->id())->offset($offset)->limit($limit)->get()->count();
//        return layui_json(0, 'success', $res['data'], $res['count']);
    }
	
	/**
	 * 表格展示
	 */
	public function infor(Request $request){
		$res = Table::where('user_id',$this->guard()->id())->get()->toArray();
		$data['title'] = array_unique(array_column($res, 'title'));
		$data['num'] = array_unique(array_column($res, 'num'));
		$data['detail'] = array_unique(array_column($res, 'detail'));
		$data['created_at'] = array_unique(array_column($res, 'created_at'));
		$data['updated_at'] = array_unique(array_column($res, 'updated_at'));
//		dd($cagids);
//		$data['title'] = array_values(Table::where('user_id',$this->guard()->id())->get('title')->toArray());
//		$data['num'] = array_values(Table::where('user_id',$this->guard()->id())->get('num')->toArray());
//		$data['detail'] = array_values(Table::where('user_id',$this->guard()->id())->get('detail')->toArray());
//		$data['created_at'] = array_values(Table::where('user_id',$this->guard()->id())->get('created_at')->toArray());
//		$data['updated_at'] = array_values(Table::where('user_id',$this->guard()->id())->get('updated_at')->toArray());
		return json_encode($data);
	}

}
