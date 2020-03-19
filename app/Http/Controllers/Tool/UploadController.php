<?php

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Controller;
use App\Handlers\UploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
	//上传视频
	public function video(Request $request, UploadHandler $uploader)
	{
		
		// 初始化返回数据，默认是失败的
		$data = [
			'success'   => false,
			'msg'       => '上传失败!',
			'file_path' => '',
		];
		// 判断是否有上传文件，并赋值给 $file
		$type = $request->type ? $request->type : '';
		$size = $request->file->getClientSize();
		$maxSize = 1024 * 1024 * 20;
//		if ($size > $maxSize) {
//			$data['msg'] = '视频不得超过20m';
//
//			return $data;
//		}
		if ($file = $request->file) {
			// 保存图片到本地
			$result = $uploader->save($request->file, 'brief', 'admin', $type);
			// 图片保存成功的话
			if ($result) {
				$data['file_path'] = $result['path'];
				$data['msg'] = '上传成功!';
				$data['success'] = true;
				$data['code'] = 200;
				$data['data']['src'] = $result['path'];
			}
		}
		return $data;
	}
}
