<?php
include "../utils/sqlUtil.php";
/**
 * 图书档案添加
 */

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
    <label>图书名称：<input type="text" value="<?php echo $info['bookName'] ?>" name="bookName"></label>
    <label>
        图书类型：<select name="bookType">
            <option value="-1">==选择图书类型==</option>
            <?php
            for ($i = 0; $i < count($typeInfo); $i++) {
                ?>
                <option value="<?php echo $typeInfo[$i][id] ?>"><?php echo $typeInfo[$i][typeName] ?></option>
            <?php } ?>
        </select>
    </label>
    <label>
        书架名称：<select name="bookCase">
            <option value="-1">==选择书架==</option>
            <?php
            for ($i = 0; $i < count($caseInfo); $i++) {
                ?>
                <option value="<?php echo $caseInfo[$i][id] ?>"><?php echo $caseInfo[$i][caseName] ?></option>
            <?php } ?>
        </select>
    </label>
    <label>
        出&nbsp;&nbsp;版&nbsp;&nbsp;社：<select name="bookPress">
            <option value="-1">==选择出版社==</option>
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

    $sql1 = "insert into tb_stock(bookId,bookSum) values (".$bookId.",'".$bookStock."')";
    $sql = "insert into tb_book(bookName,bookTypeId,bookCaseId,bookPressId,bookAuthor,bookPrice) 
values('".$bookName."',".$bookType.",".$bookCase.",".$bookPress.",'".$bookAuthor."','".$bookPrice."')";  //插入到数据库
//    echo $sql;
    update($sql);
    echo $bookStock;
    //同步加入到库存tb_stock表中
    $sql = "select id from tb_book  ORDER BY id desc LIMIT 1";
    $id = query($sql)[0][id];
//    echo "<br>".$id;
    $insert = "insert into tb_stock values(null ,$bookStock,$id) ";
    update($insert);
    echo "<script>alert('添加成功');window.opener.location.reload();window.close();</script>";
}
?>

