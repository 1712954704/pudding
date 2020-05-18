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
			return layui_json(201,$res['msg']);
		}
		$path = 'storage/'.$request->file('file')->store('word','drama');
//		$path = 'storage';
		if($path){
//			$file = "http://www.pudding.test/storage/word/U0WIJTForZgL2XSlyxxxSUi7kAhZxZwF0lUvly5a.doc";
//		$file = "storage/word/U0WIJTForZgL2XSlyxxxSUi7kAhZxZwF0lUvly5a.doc";
			$file = $path;

//            if ('docx' == $file_ext) {   // 判断word文件类型
//                $inputFileType = 'Word2007'; //Word2007及以上 TODO
//            } else {
//                // $this->openOfficePreview($inputFileName);//调用openoffice处理吧
//                $inputFileType = 'MsDoc'; //Word97-2003 但是会乱码 何解？ TODO
//            }

            $phpWord = \PhpOffice\PhpWord\IOFactory::load($file,'Word2007');
//        $sections = $phpWord->getSections();
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
			$objWriter->save('hello.html');

			$file = fopen("hello.html", "r");
			//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
			$contents = fread($file, filesize ('hello.html'));
			fclose($file);
			$html = new \Html2Text\Html2Text($contents);
			$txt = $html->getText();

			// 创建文件并写入
			$myfile = fopen("hello.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $txt);
			fclose($myfile);
//			$data['src'] = 'http://www.xioabuding.top/hello.txt';
			$data['src'] = '/hello.txt';
			return layui_json(200,'上传成功',$data);
		}else{
			return layui_json(200,'上传失败');
		}
	}
}
