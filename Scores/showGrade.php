<?php
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
    <link rel="stylesheet" type="text/css" href="css/show.css">
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
        <h2>成绩列表</h2>
        <form method="post" action="showGrade.php">
            姓名:<input type="text" name="name">
            课程:<input type="text" name="course">
            <input type="submit" name="submit" value="提交" id="submit">
        </form>
        <div id="center">
            <ul>
                <table align="center"  style="text-align:center;" border="1" >
                    <tr id="table">
                        <td "width: 50px;">序号</td>
                        <td style="width: 150px;">姓名</td>
                        <td style="width: 150px;">性别</td>
                        <td>年级</td>
                        <td>专业</td>
                        <td>课程</td>
                        <td>成绩</td>
                        <td>学分</td>
                        <td>学期</td>
                        <td>操作1</td>
                        <td>操作2</td>
                    </tr>
                    <?php
                    require_once "hanshu.php";//加载分页工具
                    require_once 'connect.php';
                    $name='';
                    $course='';
                    if (isset($_POST['submit'])){
                        $name= $_POST['name'];
                        $course= $_POST['course'];
                        $sqlall = "select count(*) from student,score where student.Sno=score.Sno and name like '%{$name}%' and course like '%{$course}%' ";//获取总条数
                        $resultall = $conn->query($sqlall);
                        $arr1 = $resultall->fetch_row();//获取一个数组  只有一个值的数组
                        $c = $arr1[0];//用一个变量获取这个数组的值
                        $page = new page($c,10);//一共多少条 每页显示多少条
                        $sql = "select score.id,name,sex,grade,dept,course,credit,score,term from student,score where student.Sno=score.Sno and name like '%{$name}%' and course like '%{$course}%' " .$page->limit;//拼接sql语句  分页显示
                    }
                    else{
                        $sqlall = "select count(*) from student,score where student.Sno=score.Sno";//获取总条数
                        $resultall = $conn->query($sqlall);
                        $arr1 = $resultall->fetch_row();//获取一个数组  只有一个值的数组
                        $c = $arr1[0];//用一个变量获取这个数组的值
                        $page = new page($c,10);//一共多少条 每页显示多少条
                        $sql = "select score.id,name,sex,grade,dept,course,credit,score,term from student,score where student.Sno=score.Sno " .$page->limit;//拼接sql语句  分页显示
                    }
//                    echo $sql;
                    $result = $conn->query($sql);
                    if($result){
                        $arr = $result->fetch_all();
                        foreach($arr as $v){
                            $id=$v[0];
                            echo"<tr>
        <td>{$v[0]}</td>
        <td>{$v[1]}</td>
        <td>{$v[2]}</td>
        <td>{$v[3]}</td>
        <td>{$v[4]}</td>
        <td>{$v[5]}</td>
        <td>{$v[6]}</td>
        <td>{$v[7]}</td>
        <td>{$v[8]}</td>
        <td><a href='addGrade.php?id=$id'>修改</a></td>
        <td><a href='deleteGrade.php?id=$id'>删除</a></td>
        </tr>";
                        }
                    }
                    ?>
                </table>
                <br/>
                <?php
                echo "<div align='center'>{$page->fpage()}</div>";//显示分页信息
                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</body>
<?php

?>
