<?php
// 连接到数据库
$servername = "127.0.0.1:3304";
$serverusername = "root";
$serverpassword = "root";
$dbname = "study";

// 创建连接
$conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);

//检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} else {
    echo "连接成功";
}