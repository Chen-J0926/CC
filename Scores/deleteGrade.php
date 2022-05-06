<?php
require_once 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1="delete from score where id='{$id}'";
    $result=$conn->query($sql1);
    if($result){
        echo "<script type=\"text/javascript\">alert('删除成功!');window.location.href=\"showGrade.php\"</script>";
    }
    else{
        echo 'False';
    }
}
$conn->close();
?>
