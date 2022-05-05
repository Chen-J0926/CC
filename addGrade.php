<?php
if(!$_COOKIE["user"]){
    echo "<script>alert('请先登录!');location.href=\"login.html\";</script>";
    return;
}
require_once 'connect.php';
$id='';
$name='';
$Sno='';
$score=0;
$course='';
$credit=0;
$term='大一上';
if(isset($_GET['id'])){
//    echo $_GET['id'];
    $id=$_GET['id'];
    $sql1="select score.*,student.name from score,student where student.Sno=student.Sno and id=$id";
    $result=$conn->query($sql1);
    if($result){
        while ($rows=$result->fetch_array()){
            $name=$rows['name'];
            $Sno=$rows['Sno'];
            $score=$rows['score'];
            $course=$rows['course'];
            $credit=$rows['credit'];
            $term=$rows['term'];
        }
    }
    else{
        echo 'False';
    }
}
if(isset($_GET['Sno'])){
    $Sno=$_GET['Sno'];
    $sql1="select * from student where Sno=$Sno";
    $result=$conn->query($sql1);
    if($result){
        while ($rows=$result->fetch_array()){
            $name=$rows['name'];
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
                <h3><?php echo $id?'修改成绩':'登记成绩'?></h3>
                <ul>
                    <li>
                        <label>姓名</label>
                        <input type="text" name="name" value="<?php echo $name;?>">
                    </li>
                    <li>
                        <label>课程名</label>
                        <input type="text" name="course" value="<?php echo $course;?>">
                    </li>
                    <li>
                        <label>分数</label>
                        <input type="number" name="score" value="<?php echo $score;?>">
                    </li>
                    <li>
                        <label>学期</label>
                        <select name="term" size="1" id="car_level">
                            <?php
                            if($term=='大一上'){
                                echo '
                                <option value="大一上" selected>大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大一下'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下" selected>大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大二上'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上" selected>大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大二下'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下" selected>大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大三上'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上" selected>大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大三下'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下" selected>大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            elseif ($term=='大四上'){
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上" selected>大四上</option>
                            <option value="大四下">大四下</option>
                                ';
                            }
                            else{
                                echo '
                                <option value="大一上">大一上</option>
                            <option value="大一下">大一下</option>
                            <option value="大二上">大二上</option>
                            <option value="大二下">大二下</option>
                            <option value="大三上">大三上</option>
                            <option value="大三下">大三下</option>
                            <option value="大四上">大四上</option>
                            <option value="大四下" selected>大四下</option>
                                ';
                            }
                            ?>
                        </select>
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
if (isset($_POST['submit'])) {
    $score = $_POST['score'];
    $course = $_POST['course'];
    $credit = $_POST['course'];
    $term = $_POST['term'];
    $Tno=$_COOKIE["user"];
    require_once 'connect.php';
    if (empty($course)) {
        echo "<script>alert('请先输入课程名');</script>";
    }
    else{
            if (!$id) {
                $sql="select * from score where Sno=$Sno and course='{$course}'";
                $result = $conn->query($sql);
                $rows=$result->num_rows;
                if($rows){
                    echo "<script>alert('该门课该学生已登记成绩!');</script>";
                }
                else{
                    $sql = "insert into score(Sno,Tno,score,course,credit,term)
values('{$Sno}','{$Tno}','{$score}','{$course}','{$credit}','{$term}');";
                    $result = $conn->query($sql);
                    if ($result) {
                        echo "<script>alert('添加成功!');location.href='showStudent.php';</script>";
                    }
                }
            } else {
                $sql = "update score set score='{$score}',credit='{$credit}',term='{$term}' where id='{$id}'";
//                echo $sql;
                $result = $conn->query($sql);
                if ($result) {
                    echo "<script>alert('修改成功!');location.href='showGrade.php';</script>";
                }
            }
        }
        $conn->close();
}
?>
