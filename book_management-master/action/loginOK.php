<?php
if (!session_id()) session_start();;
/**
 * 验证登录
 */
include "../utils/sqlUtil.php";
$user = $_POST['user'];
$pwd = $_POST['pwd'];
$userType = $_POST['userType'];

$sql = "select * from (select tb_user.*,tb_loginType.typeName from tb_user , tb_loginType where tb_user.loginTypeId = tb_loginType.id and tb_loginType.id = ".$userType.") as t
 where name='".$user."' and password = '".$pwd."' ";
//echo $sql;
if($info=query($sql)){
    $_SESSION['user'] = $info[0]['name'];                   //用户名
    $_SESSION['ID'] = $info[0]['id'];                       //用户名在数据库中的id
    $_SESSION['loginTypeId'] = $info[0]['loginTypeId'];     //用户类型

//    echo $_SESSION['user'];
//    echo $_SESSION[loginTypeId];
    echo "<script>window.location='../index.php';</script>";
}else{
    echo "<script>alert('用户名和密码不匹配，重新输入');history.back();</script>";    //与数据库不匹配，返回上一次页面
}
