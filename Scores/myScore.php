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
<div class="top" style="height: 40px;width:100%;background-color: #282c3a;font-size: 18px;line-height: 40px;">
    <div style="float: right;margin-right: 20px"><a href="exit.php" style="text-decoration: none;color: white">退出登录</a></div>
</div>
<div class="wrapper">
    <div id="container" align="center">
        <h2>我的成绩</h2>
        <form method="post" action="myScore.php">
            课程:<input type="text" name="course">
            学期:<input type="text" name="term">
            <input type="submit" name="submit" value="提交" id="submit">
        </form>
        <div id="center">
            <ul>
                <table align="center" width="800" style="text-align:center;" border="1" >
                    <tr id="table">
                        <td style="width: 150px;">姓名</td>
                        <td>课程</td>
                        <td>成绩</td>
                        <td>学分</td>
                        <td>学期</td>
                    </tr>
                    <?php
                    require_once "hanshu.php";//加载分页工具
                    require_once 'connect.php';
                    $term='';
                    $course='';
                    $Sno=$_COOKIE["user"];
                    if (isset($_POST['submit'])){
                        $term= $_POST['term'];
                        $course= $_POST['course'];
                        $sqlall = "select count(*) from student,score where student.Sno=score.Sno and score.Sno=$Sno and term like '%{$term}%' and course like '%{$course}%' ";//获取总条数
                        $resultall = $conn->query($sqlall);
                        $arr1 = $resultall->fetch_row();//获取一个数组  只有一个值的数组
                        $c = $arr1[0];//用一个变量获取这个数组的值
                        $page = new page($c,10);//一共多少条 每页显示多少条
                        $sql = "select name,course,credit,score,term from student,score where student.Sno=score.Sno and score.Sno=$Sno and term like '%{$term}%' and course like '%{$course}%' " .$page->limit;//拼接sql语句  分页显示
                    }
                    else{
                        $sqlall = "select count(*) from student,score where student.Sno=score.Sno and score.Sno=$Sno";//获取总条数
                        $resultall = $conn->query($sqlall);
                        $arr1 = $resultall->fetch_row();//获取一个数组  只有一个值的数组
                        $c = $arr1[0];//用一个变量获取这个数组的值
                        $page = new page($c,10);//一共多少条 每页显示多少条
                        $sql = "select name,course,credit,score,term from student,score where student.Sno=score.Sno and score.Sno=$Sno " .$page->limit;//拼接sql语句  分页显示
                    }
//                    echo $sql;
                    $result = $conn->query($sql);
                    if($result){
                        $arr = $result->fetch_all();
                        foreach($arr as $v){
                            echo"<tr>
        <td>{$v[0]}</td>
        <td>{$v[1]}</td>
        <td>{$v[2]}</td>
        <td>{$v[3]}</td>
        <td>{$v[4]}</td>
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

