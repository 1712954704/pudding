<?php
	namespace App\Handlers;

	use Illuminate\Support\Str;

	class UploadHandler
	{
		// 只允许以下后缀名的图片文件上传
		protected $photo = ["png", "jpg", "gif", 'jpeg','bmp'];
		protected $video = ["mp4"];
		protected $word = ["docx"];
		protected $byte = 1024 * 1024;

		/**
		 * 文件上传验证
		 * file 文件
		 * size 大小
		 * type 类型
		 * return array   code 0 正常 1 文件大小验证不通过  2 文件类型验证不通过
		*/
		public function verify($file, $size ,$type =''){

//			dd($file->extension());  获取文件后缀名
//			dd($file->getClientOriginalExtension());
			$data = [
				'code' => 0,
				'msg'  => '',
			];
			//限制上传文件的大小
			if ($file->getSize() >= ($size * $this->byte)) {
				$data['code'] = 1;
				$data['msg'] = '请上传'.$size.'兆以内的文件';
				return $data;
			}
			//文件类型验证
			switch ($type){
				case 'video' : // 视频
					if(!in_array(strtolower($file->extension()),$this->video)){
						$data['code'] = 2;
						$data['msg'] = '上传文件格式不正确';
						return $data;
					};
					break;
				case 'img' : // 图片
					if(!in_array(strtolower($file->extension()),$this->photo)){
						$data['code'] = 2;
						$data['msg'] = '上传文件格式不正确';
						return $data;
					};
					break;
				case 'word' : // 图片
					if(!in_array(strtolower($file->extension()),$this->word)){
						$data['code'] = 2;
						$data['msg'] = '上传文件格式不正确';
						return $data;
					};
					break;
				default: // 默认
					$data['code'] = 2;
					$data['msg'] = 'type不能为空';
					return $data;
			}
			return $data;
		}

		public function save($file, $folder, $file_prefix,$type='')
		{
			$file_size = 2097152;//固定文件大小2MB
			//限制上传文件的大小
//			if ($file->getClientSize() >= $file_size) {
//				return layui_json(404, '请上传两兆以内的文件');
//			}
			//$file->getClientSize()获取文件大小
			// 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
			$folder_name = "upload/video/drama/$folder/" . date("Ym/d", time());
			// 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
			// 值如：/home/vagrant/Code/lara/public/uploads/images/avatars/201709/21/
			$upload_path = public_path() . '/' . $folder_name;

			// 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
			$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

			// 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
			// 值如：1_1493521050_7BVc9v9ujP.png
//			Str::random(12)
//			$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
			$filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

			// 如果上传的不是图片将终止操作
//			if (!in_array($extension, $this->$photo)) {
//				return layui_json(404, '上传文件格式不正确!');
//			}

			// 将图片移动到我们的目标存储路径中
			$re =  $file->move($upload_path, $filename);

			if(!$re){
				return layui_json(404, '上传失败!');
			}
//        if($type == "banner"){
//            // 判断宽高 682*246px
//            $editor = Grafika::createEditor();
//            $editor->open( $image,  $upload_path.'/'.$filename);
//            $height = $image->getHeight();
//            $width = $image->getWidth();
//
//            if($height != 246 || $width != 682){
//                unlink($upload_path.'/'.$filename);
//                return false;
//            }
//        }

			return [
				'path' => config('app.url') .'/'. "$folder_name/$filename"
			];
		}
	}
