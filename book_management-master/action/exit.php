<?php
if (!session_id()) session_start();;
//销毁session变量
session_unset();    //删除session中的变量
session_destroy();  //销毁session ID
header("location:../login.php");