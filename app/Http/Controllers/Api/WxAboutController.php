<?php
namespace app\controller\api;

use App\Http\Controllers\Controller;

class WxAboutController extends Controller
{
    public function deploy(){
        /**
         * 微信服务器配置
         */
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = "Q66T5QTomfnuFzFYpsKwCq1DELqPIAA5";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
