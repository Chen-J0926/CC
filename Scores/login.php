<?php
if (isset($_POST['submit'])){
    if(empty($_POST['username'])){
        echo "<script>alert('请先输入用户名');history.go(-1);</script>";
        return;
    }
    if(empty($_POST['password'])){
        echo "<script>alert('请先输入密码');history.go(-1);</script>";
        return;
    }
    if(empty($_POST['role'])){
        echo "<script>alert('请先选择角色');history.go(-1);</script>";
        return;
    }
    require_once 'connect.php';
    $username= $_POST['username'];
    $password=$_POST['password'];
    if($_POST['role']==2){
        $sql ="select * from teacher where Tno='$username' and password='$password';";
        $result = $conn->query($sql);
        $rows=$result->num_rows;
        if($rows){
            setcookie("user", $username);
            echo "<script>alert('登录成功!');location.href=\"index.php\";</script>";
        }
//        echo $_POST['role'];
    }
    else{
        $sql ="select * from student where Sno='$username' and password='$password';";
        $result = $conn->query($sql);
        $rows=$result->num_rows;
        if($rows){
            setcookie("user", $username);
            echo "<script>alert('登录成功!');location.href=\"myScore.php\";</script>";
        }
    }
}
$conn->close();
?>
<div>abc</div>
