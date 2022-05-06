<?php
include "../utils/sqlUtil.php";
/**
 * 图书档案修改
 */
$id = $_GET['recordId'];
$sql = "select * from  tb_book, tb_stock where tb_book.id=" . $id;
$info = query($sql)[0];

$type = "select * from tb_booktype";    //图书类型
$typeInfo = query($type);

$case = "select * from tb_case";    //书架
$caseInfo = query($case);

$press = "select * from tb_press";      //出版社
$pressInfo = query($press);

?>
<style>
    form label {
        display: block;
        margin: 5px;
    }

    label input,label select {
        width: 150px;
        padding: 2px;
    }
</style>
<form action="" method="post">
    <label>编&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<input type="text" disabled
                                                               value="<?php echo $info['id'] ?>"></label>
    <label>图书名称：<input type="text" value="<?php echo $info['bookName'] ?>" name="bookName"></label>
    <label>
        图书类型：<select name="bookType">
            <?php
            for ($i = 0; $i < count($typeInfo); $i++) {
                ?>
                <option value="<?php echo $typeInfo[$i][id] ?>"><?php echo $typeInfo[$i][typeName] ?></option>
            <?php } ?>
        </select>
    </label>
    <label>
        书架名称：<select name="bookCase">
            <?php
            for ($i = 0; $i < count($caseInfo); $i++) {
                ?>
                <option value="<?php echo $caseInfo[$i][id] ?>"><?php echo $caseInfo[$i][caseName] ?></option>
            <?php } ?>
        </select>
    </label>
    <label>
        出&nbsp;&nbsp;版&nbsp;&nbsp;社：<select name="bookPress">
            <?php
            for ($i = 0; $i < count($pressInfo); $i++) {
                ?>
                <option value="<?php echo $pressInfo[$i][id] ?>"><?php echo $pressInfo[$i][pressName] ?></option>
            <?php } ?>
        </select>
    </label>
    <label>作&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;者：<input type="text" value="<?php echo $info['bookAuthor'] ?>"
                                                               name="bookAuthor"></label>
    <label>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：<input type="text" value="<?php echo $info['bookPrice'] ?>"
                                                               name="bookPrice"></label>
    <label>库&nbsp;&nbsp;存&nbsp;&nbsp;量：<input type="text" value="<?php echo $info['bookSum'] ?>" name="bookStock"></label>
    <input type="submit" name="submit">
</form>

<?php
if ($_POST['submit']) {
    $bookName = $_POST[bookName];
    $bookType = $_POST[bookType];
    $bookCase = $_POST[bookCase];
    $bookPress = $_POST[bookPress];
    $bookAuthor = $_POST[bookAuthor];
    $bookPrice = $_POST[bookPrice];
    $bookStock = $_POST[bookStock];

    $sql = "update tb_book set bookName='".$bookName."',bookTypeId=".$bookType.",bookCaseId=".$bookCase.",bookPressId=".$bookPress.",
     bookAuthor='".$bookAuthor."',bookPrice='".$bookPrice."' where id=".$id;  //更新数据库
    update($sql);
    echo "<script>alert('修改成功');window.opener.location.reload();window.close();</script>";
}
?>

