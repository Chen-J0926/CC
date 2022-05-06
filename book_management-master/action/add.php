<?php
error_reporting(0);
/**
 * 添加书架
 * 添加图书类型
 * 添加读者类型
 */
$inputName = "";
$tableCol = "";
if ($_GET['addId']=="case"){  //添加书架
    $inputName = "书架名";
    $tableCol = "tb_case(caseName)";
}
if ($_GET['addId']=="reader"){  //添加读者类型
    $inputName = "读者类型名";
    $tableCol = "tb_loginType(typeName)";
}
if ($_GET['addId']=="book"){  //添加图书类型
    $inputName = "图书类型名";
    $tableCol = "tb_bookType(typeName)";
}
?>

<form action="" method="post" style="text-align: center">
    <?php echo $inputName?>：<input type="text" name="name"><br>
    <input type="submit" name="submit">
</form>
<?php
if ($_POST['submit']){
    include "../utils/sqlUtil.php";
    $sql = "insert into ".$tableCol." value('".$_POST[name]."') ";
//    echo $sql;
    update($sql);
    echo "<script>alert('添加成功');window.opener.location.reload();window.close();</script>";
}

?>

