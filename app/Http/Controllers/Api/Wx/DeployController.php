<?php

namespace App\Http\Controllers\Api\Wx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeployController extends Controller
{
    /**
     * 微信配置
    */
    public function index(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = "g72q5zi7AC9Tyv7gCwS7BeoqzBTpL5k6";
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
