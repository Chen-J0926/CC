<?php
include "../utils/sqlUtil.php";
/**
 *续借操作
 */
date_default_timezone_set("PRC");
$readerId = $_GET[readerId];    //读者编号
$bookId = $_GET[bookId];    //读者编号
$backDate = date("Y-m-d",time()+(30*24*60*60)); //续借后归还日期
$sql = "update tb_bookborrow set returnData='".$backDate."' where readerId=".$readerId." and bookId= ".$bookId;
update($sql);
echo "<script>alert('续借成功');self.location=document.referrer;</script>";


