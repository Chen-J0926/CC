<?php
//echo $_COOKIE["user"];
if(!$_COOKIE["user"]){
    echo "<script>alert('请先登录!');location.href=\"login.html\";</script>";
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <style>
        #container{
            position: relative;
            font-size: 38px;
            font-family: 华文彩云;
        }
        #container p{
            text-align: center;
            margin-top: 40px;
            line-height: 100%;
        }
        #container img{
            margin: 20px 100px 0 250px;
            width: 250px;
            height: 250px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="wrap">
        <div class="nav">
            <ul>
                <li class="list">
                    <h2><i></i>首页</h2>
                    <div class="hide">
                        <p><a href="index.php">返回首页</a></p>
                        <p><a href="exit.php"">注销登录</a></p>
                    </div>
                </li>
                <li class="list">
                    <h2><i></i>学生信息</h2>
                    <div class="hide">
                        <p><a href="addStudent.php">添加学生信息</a></p>
                        <p><a href="showStudent.php">学生信息列表</a></p>
                    </div>
                </li>
                <li class="list">
                    <h2><i></i>成绩管理</h2>
                    <div class="hide">
                        <p><a href="showGrade.php">成绩列表</a></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        (function () {
            var oList = document.querySelectorAll('.list h2'),
                oHide = document.querySelectorAll('.hide'),
                oIcon = document.querySelectorAll('.list i'),
                lastIndex = 0;
            for(var i=0;i<oList.length;i++){
                oList[i].index = i;//自定义属性
                oList[i].isClick = false;
                oList[i].initHeight = oHide[i].clientHeight;
                oHide[i].style.height = '0';
                oList[i].onclick = function () {
                    if(this.isClick){
                        oHide[this.index].style.height = '0';
                        oIcon[this.index].className = '';
                        oList[this.index].className = '';
                        oList[this.index].isClick = false;
                    }
                    else{
                        oHide[lastIndex].style.height = '0';
                        oIcon[lastIndex].className = '';
                        oList[lastIndex].className = '';
                        oHide[this.index].style.height = '';
                        oIcon[this.index].className = 'on';
                        oList[this.index].className = 'on';
                        oList[lastIndex].isClick = false;
                        oList[this.index].isClick = true;
                        lastIndex = this.index;
                    }
                }
            }
        })();
    </script>
    <div id="container">
        <p>欢迎登录</p>
        <p>请选择你需要的操作</p>
    </div>
</body>
