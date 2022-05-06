<?php
if (!session_id()) session_start();;
if ($_SESSION['user'] ==""){
    echo "<script>alert('请先登录');window.location='login.php';</script>";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>图书馆系统首页</title>
    <style>
        iframe,footer{
            width: 960px;
            position: relative;
            left: 50%;
            margin-left: -480px;
            border-left: #1f6098 solid 1px;
            border-right: #1f6098 solid 1px;
            overflow-x: hidden;
        }
        nav {
            position: absolute;
            width: 960px;
            left: 50%;
            margin-left: -480px;
            margin-top: 5px;
            border: #1f6098 solid 1px;
            border-bottom: none;
            z-index: 1;
        }

        iframe {
            border-bottom: #306baf solid 1px;
            height: calc(80vh - 3px);
            margin-top: 130px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<nav><?php include "nav.php";?></nav>
<iframe src="content.php" frameborder="0" name="content"></iframe>
<footer><?php include "footer.php";?></footer>
</body>
</html>