<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/9/28
 * Time: 14:33
 */

namespace Response;

class Response
{
    static public function send($code, $msg, $data)
    {
        echo json_encode(['code'=>$code, 'msg'=>$msg, 'data'=>$data]);
        exit;
    }
}