<?php
if(!$_COOKIE["user"]){
    echo "<script>alert('请先登录!');location.href=\"login.html\";</script>";
    return;
}
require_once 'connect.php';
$id='';
$name='';
$sex='男';
$grade='大一';
$dept='';
if(isset($_GET['id'])){
//    echo $_GET['id'];
    $id=$_GET['id'];
    $sql1="select * from student where Sno=$id";
    $result=$conn->query($sql1);
    if($result){
        while ($rows=$result->fetch_array()){
            $name=$rows['name'];
            $sex=$rows['sex'];
            $grade=$rows['grade'];
            $dept=$rows['dept'];
        }
    }
    else{
        echo 'False';
    }

}
//$conn->close();
//echo  $sex;
//echo $sex=='男'?'true':'false';
//echo  $sex=='女';
//echo $id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/addStudent.css">
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
        <form method="post" name="student">
            <fieldset>
                <h3><?php echo $id?'修改学生':'新增学生'?></h3>
                <ul>
                    <li>
                        <label>姓名</label>
                        <input type="text" name="name" value="<?php echo $name;?>">
                    </li>
                    <li>
                        <label>性别</label>
                        <?php
                        if($sex=='男'){
                            echo '<input type="radio" name="sex1" value="男" checked=true />男
                        <input type="radio" name="sex1" value="女" />女';
                        }
                        else{
                           echo '<input type="radio" name="sex1" value="男" checked=true />男
                        <input type="radio" name="sex1" value="女" checked=false />女';
                        }
                        ?>
                    </li>
                    <li>
                        <label>年级</label>
                        <select name="grade" size="1" id="car_level">
                            <?php
                            if($grade=='大一'){
                                echo '
                                <option value="大一" selected>大一</option>
                            <option value="大二">大二</option>
                            <option value="大三">大三</option>
                            <option value="大四">大四</option>
                                ';
                            }
                            elseif ($grade=='大二'){
                                echo '
                                <option value="大一">大一</option>
                            <option value="大二" selected>大二</option>
                            <option value="大三">大三</option>
                            <option value="大四">大四</option>
                                ';
                            }
                            elseif ($grade=='大三'){
                                echo '
                                <option value="大一">大一</option>
                            <option value="大二">大二</option>
                            <option value="大三" selected>大三</option>
                            <option value="大四">大四</option>
                                ';
                            }
                            else{
                                echo '
                                <option value="大一">大一</option>
                            <option value="大二">大二</option>
                            <option value="大三">大三</option>
                            <option value="大四" selected>大四</option>
                                ';
                            }
                            ?>

                        </select>
                    </li>
                    <li>
                        <label>专业</label>
                        <input type="text" name="dept" value="<?php echo $dept;?>">
                    </li>

                    <li>
                        <input type="submit" name="submit" value="提交" id="submit">
                    </li>
                </ul>
            </fieldset>
        </form>
    </div>
</body>
<?php
if (isset($_POST['submit'])){
    $name=$_POST['name'];
    $grade=$_POST['grade'];
    $dept=$_POST['dept'];
    $sex=$_POST['sex1'];
    require_once 'connect.php';
    if(empty($name)){
        echo "<script>alert('请先输入学生姓名');</script>";
    }
    else{
        if(empty($dept)){
            echo "<script>alert('请先输入专业');</script>";
        }
        else{
            if(!$id){
                $sql ="insert into student(name,sex,grade,dept)
values('{$name}','{$sex}','{$grade}','{$dept}');";
                $result=$conn->query($sql);
                if($result){
                    echo "<script>alert('添加成功!');location.href='addStudent.php';</script>";
                }
            }
            else{
                $sql ="update student set name='{$name}',sex='{$sex}',grade='{$grade}',dept='{$dept}' where Sno='{$id}'";
//                echo $sql;
                $result=$conn->query($sql);
                if($result){
                    echo "<script>alert('修改成功!');location.href='showStudent.php';</script>";
                }
            }
        }
    }
    $conn->close();
}
?>
