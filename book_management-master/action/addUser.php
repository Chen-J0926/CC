<?php
include "../utils/sqlUtil.php";
/**
 * 添加用户
 */
$sql = "select * from tb_loginType where id <>3";
$info = query($sql);
?>
<style>
    label.display {
        position: absolute;
        display: none;
    }
    label, .input {
        display: block;
        margin-top: 5px;
    }
</style>
<form action="" method="post">
    <label>用户名：<input type="text" name="user"></label>
    <label>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd"></label>
    <label class="<?php echo $_GET[loginType]==3? 'display':'' ?>">用户类型：
        <select name="type">
            <option value="-1">==选着用户类型==</option>
            <?php
            for ($i = 0; $i < count($info); $i++) {
                ?>
                <option value="<?php echo $info[$i][id]; ?>"><?php echo $info[$i][typeName]; ?></option>
            <?php } ?>
        </select>
    </label>
    <input type="submit" name="submit" class="input">
</form>
<?php
if ($_POST['submit']){
    $user = $_POST[user];
    $pwd = $_POST[pwd];
    $type = "";
    if ($_GET[loginType]==3){
        $type = $_GET[loginType];
    }else{
        $type = $_POST[type];
    }
    $sql = "insert into tb_user(name,password,loginTypeId) values('".$user."','".$pwd."','".$type."')";
    echo $sql;
    update($sql);
    //同步加入到权限tb_permission表中
    $sql = "insert into tb_permission(userId)
SELECT id from tb_user
where id not in
(select userId from tb_permission)";
    update($sql);
    echo "<script>alert('添加成功');window.opener.location.reload();window.close();</script>";
}
?>

