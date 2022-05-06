<?php
include "../utils/sqlUtil.php";
$sql = "select count(readerId) from tb_bookborrow where returnFlag=0 and  readerId = '".$_POST[readerId]."'";
$info = query($sql)[0];
//            echo $info[0];
if ($info[0] >1){
    echo "<script>alert('该读者借书数量已达最大数量，请先归还书籍！')</script>";
}else{
    //借书没有达到最大数量执行借书操作
    date_default_timezone_set("PRC");
    $borrowDate = date("Y-m-d");
    $backDate = date("Y-m-d",time()+(30*24*60*60));
    $sql = "insert into tb_bookborrow values (null,".$_POST[readerId].",".$_POST[bookId].",'".$borrowDate."',0,'".$backDate."')";
//            echo $sql;
    update($sql);
    echo "<script>alert('借书成功');self.location=document.referrer;</script>";
}