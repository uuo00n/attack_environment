<?php
/**
 * @project tp5
 * @author https://github.com/uuo00n
 * @date 2023 2月 20
 *
 */

namespace app\ui\controller;

use think\Cookie;
use think\Db;
use think\Session;

class Indexpage
{
    public function pageInit()
    {
//        if (Session::get("login")){
//            $result = [
//                "sucess" => false,
//                "msg" => "请重新登录",
//                "data"
//            ];
//            echo json_encode($result);
//            return;
//        }
        $sql = "SELECT * FROM study.message where status = '未读' AND message.recive_id=" . Cookie::get("userID");
        $dbResult = Db::query($sql);
        $result = [
            "success" => true,
            "data" => ["message" => [
                "count" => count($dbResult),
                "messageList" => $dbResult
            ]]
        ];

        echo json_encode($result);
    }
}