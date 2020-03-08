<?php

/**
 * 返回layui需要的json格式
 */
function layui_json($code = 200, $msg = "success",$data = array(),  $count = 0)
{
    $list = ['code' => $code,'msg' => $msg, 'data' => $data, 'count' => $count];
    return json_encode($list);
}
