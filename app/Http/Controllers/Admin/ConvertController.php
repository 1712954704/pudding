<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\UploadHandler;
use App\Http\Controllers\Controller;
use Html2Text\Html2Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;

class ConvertController extends Controller
{
    /**
	 * 测试转换txt
    */
    public function index(){
    	return view('admin.convert.index');
	}
	
	/**
	 * 接收上传word并解析
	*/
	public function analysis(Request $request,UploadHandler $uploader){
		$res = $uploader->verify($request->file('file'),100,'word');
		if($res['code'] != 0){
			return layui_json(200,$res['msg']);
		}
		$path = 'storage/'.$request->file('file')->store('word','drama');
		if($path){
//			$file = "http://www.pudding.test/storage/word/56ODMOhpdu631Hp4gZ9Zew0f9UIl0V0tZnpqjnhZ.docx";
//		$file = "storage/word/56ODMOhpdu631Hp4gZ9Zew0f9UIl0V0tZnpqjnhZ.docx";
			$file = $path;
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($file);
			$sections = $phpWord->getSections();
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
			$objWriter->save('helloWorld.html');

			$file = fopen("helloWorld.html", "r");
			//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
			$contents = fread($file, filesize ('helloWorld.html'));
			fclose($file);
			$html = new \Html2Text\Html2Text($contents);
			$txt = $html->getText();
			
			// 创建文件并写入
			$myfile = fopen("hello.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $txt);
			fclose($myfile);
			$data['src'] = 'http://www.pudding.test/hello.txt';
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
}
