<?php

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Controller;
use App\Handlers\UploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
	//上传视频
	public function video(Request $request, UploadHandler $uploader)
	{
		$res = $uploader->verify($request->file('file'),100,'video');
		if($res['code'] != 0){
			return layui_json(200,$res['msg']);
		}
		$path = $request->file('file')->store('drama','drama');
		if($path){
			$data['src'] = Storage::disk('drama')->url($path);
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
	
	// 上传富文本图片
	public function richImage(Request $request,UploadHandler $uploader){
		$res = $uploader->verify($request->file('file'),20,'img');
		if($res['code'] != 0){
			return layui_json(200,$res['msg']);
		}
		$path = $request->file('file')->store('image','drama');
		if($path){
			$data['src'] = Storage::disk('drama')->url($path);
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
	
	// 上传word
	public function word(Request $request,UploadHandler $uploader){
		$res = $uploader->verify($request->file('file'),100,'word');
		if($res['code'] != 0){
			return layui_json(200,$res['msg']);
		}
		$path = $request->file('file')->store('word','drama');
		if($path){
			$data['src'] = Storage::disk('drama')->url($path);
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
	
	// 删除上传文件
	public function delFile(Request $request){
		if($request->imgpath){
			$file = pathinfo($request->imgpath);
			$res = Storage::disk('drama')->delete('image/'.$file['basename']);
		}else{
			$file = pathinfo($request->filepath);
			$res = Storage::disk('drama')->delete('drama/'.$file['basename']);
		}
		if ($res){
			return layui_json(200,'删除成功');
		}
		return layui_json(201,'删除失败');
	}
}
