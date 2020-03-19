<?php
	namespace App\Handlers;
	
	use Illuminate\Support\Str;
	
	class UploadHandler
	{
		// 只允许以下后缀名的图片文件上传
		protected $allowed_ext = ["png", "jpg", "gif", 'jpeg','bmp'];
		
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
//			if (!in_array($extension, $this->allowed_ext)) {
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
