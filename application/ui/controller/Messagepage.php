<?php


namespace app\ui\controller;

use think\Db;
use think\Cookie;
use think\db\Query;
use think\Request;

class Messagepage
{
    public function getMessageList()
    {
        $sql = "SELECT * FROM study.message where recive_id=" . Cookie::get("userID");
        $dbResult = Db::query($sql);
        $result = [
            "success" => true,
            "msg" => "",
            "data" => $dbResult
        ];
        echo json_encode($result);
    }

    public function getUserList()
    {
        $sql = "SELECT id,name FROM study.user WHERE account_status='正常'";
        $dbResult = Db::query($sql);
        $result = [
            "success" => true,
            "msg" => "",
            "data" => $dbResult
        ];
        echo json_encode($result);
    }

    public function sendMessage()
    {
        $req = Request::instance();
        $sendID = Cookie::get("userID");
        $recvID = $req->param("receiveID");
        $msg = $req->param("message");
        $sql = "INSERT into study.message(send_id,recive_id,message,status) VALUES ('$sendID','$recvID','$msg','未读')";
        Db::query($sql);
        $result = [
            "success" => true,
            "msg" => "",
            "data" => "消息发送成功"
        ];
//     else{
//         $result =[
//             "success"=>false,
//             "msg"=>"消息发送失败",
//             "data"=>""
//         ];
//     }
        echo json_encode($result);
    }

    public function searchMessage()
    {
        $req = Request::instance();
        $keyword = $req->param("keyword");
        $sql = "SELECT * FROM study.message Where message LIKE '%$keyword%' limit 0,1";
        $dbResult = Db::query($sql);
        if (count($dbResult) === 1) {
            $result = [
                "success" => true,
                "msg" => "",
                "data" => $dbResult[0]
            ];
        } else {
            $result = [
                "success" => false,
                "msg" => "当前关键字没有搜索到消息",
                "data" => ""
            ];
        }
        echo json_encode($result);
    }
}