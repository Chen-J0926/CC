<?php
require_once 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1="delete from student where Sno='{$id}'";
    $result=$conn->query($sql1);
    if($result){
        echo "<script type=\"text/javascript\">alert('删除成功!');window.location.href=\"showStudent.php\"</script>";
    }
    else{
        echo 'False';
    }
}
$conn->close();
?>

