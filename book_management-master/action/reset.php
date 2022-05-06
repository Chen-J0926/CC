<?php
error_reporting(0);
/**
 * 修改书架
 * 修改图书类型
 * 修改读者类型
 */
$resetId = $_GET['resetId'] ;
$from = $_GET['from'];
$inputName = "";
$input = "";
$table = "";    //表名
$col = "";      //字段
if ($from=="case"){  //修改书架
    $inputName = "书架名";
    $table = "tb_case";
    $col = "caseName";
    $input = "<input type=\"text\" name=\"caseName\">";
}
if ($from=="reader"){  //修改读者类型
    $inputName = "读者类型名";
    $table = "tb_loginType";
    $col = "typeName";
    $input = "<input type=\"text\" name=\"caseName\">";
}
if ($from=="book"){  //修改图书类型
    $inputName = "图书类型名";
    $table = "tb_bookType";
    $col = "typeName";
    $input = "<input type=\"text\" name=\"caseName\">";
}

if ($from=="update"){
    $inputName = "用户名";
    $table = "tb_user";
    $col = "password";
    $input = "<input type='text' disabled value='".$_GET[user]."' ><br>
密&nbsp;&nbsp;&nbsp;码：<input type='text' name='caseName'>";
}
?>
<form action="" method="post">
    编&nbsp;&nbsp;&nbsp;号：<input type="text" disabled value='<?php echo $resetId?>'><br>
    <?php echo $inputName?>：<?php echo $input?><br>
    <input type="submit" value="确认" name="submit">
    <input type="button" value="取消" onclick="window.close();">
</form>
<?php
include "../utils/sqlUtil.php";
if ($_POST['submit']){
    $sql = "update ".$table." set ".$col."='".$_POST[caseName]."' where id=".$resetId;
//    echo $sql;
    update($sql);
    echo "<script>window.opener.location.reload();window.close();</script>";
}
?>
