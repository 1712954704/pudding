<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

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
        $limit = $request->limit;
        $offset = ($request->page - 1) * $limit;
        $res['data'] = Table::where('user_id',$this->guard()->id())->offset($offset)->limit($limit)->get()->toArray();
        $res['count'] = Table::where('user_id', $this->guard()->id())->offset($offset)->limit($limit)->get()->count();

        return layui_json(0, 'success', $res['data'], $res['count']);
    }
}
