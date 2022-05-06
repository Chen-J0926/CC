<?php
$userName='root';
$passWord='123456789';
$host='127.0.0.1';
$dataBase='scores';
$conn = new mysqli($host, $userName, $passWord, $dataBase);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
?>
