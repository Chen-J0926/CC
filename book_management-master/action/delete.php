<?php
/**
 *删除活动
 */
if (!session_id()) session_start();;
include "../utils/sqlUtil.php";
$sql = "";
if ($_GET['from'] == 'management') {//管理员
    $arr_str = $_SESSION['actionUserId'];         //反序列
    $actionUserId = unserialize($arr_str);      //数组存着管理员用户在数据库中的userId
    $index = $_GET['userId'] - 1;                     //$actionUserId下标
    $sql = "DELETE u,p FROM tb_user u LEFT OUTER JOIN tb_permission p ON u.id = p.userId WHERE p.userId =" . $actionUserId[$index];
}
if ($_GET['from'] == 'case') {//书架
    $sql = "DELETE from tb_case where id=" . $_GET[caseId];
}
if ($_GET['from'] == 'reader') {//读者
    $sql = "DELETE from tb_logintype where id=" . $_GET[readerId];
}
if ($_GET['from'] == 'book') {//图书
    $sql = "DELETE from tb_booktype where id=" . $_GET[bookId];
}

if ($_GET['from'] == 'readerRecord') {//读者档案
    $sql = "DELETE from tb_user where id=" . $_GET['recordId'];
}

if ($_GET['from'] == 'bookRecord') {//图书档案
    $sql = "DELETE from tb_boo where id=" . $_GET['recordId'];
}
update($sql);
echo "<script>self.location=document.referrer;</script>";