<style>
    form {
        margin-top: 20px;
    }
</style>
<?php
/**
 *修改信息
 */
$id = $_GET[id];
?>
<form action="" method="post">
    <table>
        <tr><td>图书馆名称：</td><td><input type="text" name="name"></td></tr>
        <tr><td>馆&nbsp;&nbsp;&nbsp;长：</td><td><input type="text" name="curator"></td></tr>
        <tr><td>地&nbsp;&nbsp;&nbsp;址：</td><td><input type="text" name="address"></td></tr>
        <tr><td>联系方式：</td><td><input type="text" name="phone"></td></tr>
        <tr><td>官网网址：</td><td><input type="text" name="URL"></td></tr>
        <tr><td>简&nbsp;&nbsp;&nbsp;介：</td><td><textarea name="introduce"></textarea></td></tr>
    </table>

    <input type="submit" value="修改" name="submit">
    <input type="button" value="取消" onclick="window.close();">
</form>

<?php
include "../utils/sqlUtil.php";
//点击了修改，获取表单信息，将信息更新到数据库中
if($_POST['submit']){
    $name = $_POST[name];
    $curator = $_POST[curator];
    $address = $_POST[address];
    $phone = $_POST[phone];
    $URL = $_POST[URL];
    $introduce = $_POST[introduce];
    $sql = "update tb_library set libraryName='".$name."',curator='".$curator."',address='".$address."',
   phone = '".$phone."',URL = '".$URL."',introduce ='".$introduce."' where id=".$id;
    update($sql);
//    echo $sql;
    echo "<script>alert('修改成功');window.opener.location.reload();window.close();</script>";
}
?>
