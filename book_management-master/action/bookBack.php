<?php
include "../utils/sqlUtil.php";
/**
 * 还书操作
 */
$readerId = $_GET[readerId];
$bookId = $_GET[bookId];
$sql = "update tb_bookborrow set returnFlag=1 where readerId=".$readerId." and bookId=".$bookId;
update($sql);
echo "<script>alert('还书成功');self.location=document.referrer;</script>";
