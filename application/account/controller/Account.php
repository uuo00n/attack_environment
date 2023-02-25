<?php
/**
 * @project tp5
 * @author https://github.com/uuo00n
 * @date 2023 2月 22
 *
 */

namespace app\account\controller;

use think\Request;
use think\Db;
use think\Cookie;
use think\Session;

class Account
{
    public function login()
    {
        $req = Request::instance();
        $username = $req->param("username");
        $password = $req->param("password");
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $sqlResult = Db::query($sql);

        if (count($sqlResult) == 0) {
            $result = [
                "success" => false,
                "msg" => "用户不存在",
                "data" => ""
            ];
            echo json_encode($result);
            return;
        }

        if ($password != $sqlResult[0]["password"]) {
            $result = [
                "success" => false,
                "msg" => "输入密码不正确",
                "data" => ""
            ];
            echo json_encode($result);
            return;
        }

        if ($sqlResult[0]["account_status"] != "正常") {
            $result = [
                "success" => false,
                "msg" => "该账户已被禁用或未通过审核",
                "data" => ""
            ];
            echo json_encode($result);
            return;
        }

        $result = [
            "success" => true,
            "msg" => "",
            "data" => "登录成功"
        ];

        Cookie::init();
        Cookie::set("userType", $sqlResult[0]["user_type"]);
        Cookie::set("userID", $sqlResult[0]["id"]);
        Cookie::set("name", $sqlResult[0]["name"]);

        Session::set("login", true);

        echo json_encode($result);

    }
}