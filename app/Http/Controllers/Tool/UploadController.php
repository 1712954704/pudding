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
			$data['file_path'] = Storage::disk('drama')->url($path);
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
}
