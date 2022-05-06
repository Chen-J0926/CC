<?php
include "../utils/sqlUtil.php";
/**
 * 读者档案修改
 */
$id = $_GET['recordId'];
$sql = "select * from tb_loginType where id <>3";
$info = query($sql);
?>
<style>
    form label {
        display: block;
        margin: 5px;
    }
    label input,label option {
        width: 100px;
        padding: 2px;
    }
</style>

<form action="" method="post">
    <label>编&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<input type="text" disabled value="<?php echo $id ?>"></label>
    <label>读者姓名：<input type="text" name="user" value="<?php echo $_GET[user]; ?>"></label>
    <label>读者类型：<select name="type">
            <option value="-1">==选择读者类型==</option>
            <?php
            for ($i = 0; $i < count($info); $i++) {
                ?>
                <option value="<?php echo $info[$i][id]; ?>"><?php echo $info[$i][typeName]; ?></option>
            <?php } ?>
        </select>
    </label>
    <input type="submit" name="submit" value="确定">
</form>

<?php
if ($_POST['submit']) {
    $name = $_POST[user];
    $type = $_POST[type];
    $sql = "update tb_user set name='" . $name . "', loginTypeId='" . $type . "' where id = " . $id;
    update($sql);
    echo "<script>alert('修改成功');window.opener.location.reload();window.close();</script>";
}
?>

