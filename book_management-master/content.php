<?php
if (!session_id()) session_start();;
if ($_SESSION['user'] == "") {
    exit();
}
/**
 * 中间内容显示
 */
?>
<link rel="stylesheet" href="css/table.css">


<!--搜索栏-->
<div class="search">
    <form action="" method="post">
        <input type="text" name="key" placeholder="输入要查找的信息" class="sch">
        <button type="submit">快速搜索</button>
        <label>
            <input type="radio" name="search" checked value="1">书名
            <input type="radio" name="search" value="2">作者
            <input type="radio" name="search" value="3">出版社
        </label>
    </form>
</div>
<img src="images/main_booksort.gif" alt="" width="100%">
<!--显示数据-->
<div class="content">
    <table id="content">
        <?php
        error_reporting(0);
        include "utils/tableUtil.php";
        include "utils/pagingUtil.php";
        include "utils/pagingSql.php";
        $headerTitle = array("图书名", "图书类型", "书架名称", "出版社", "作者", "价格", "库存量", "可借数量", "借阅次数"); //设置表头
        createHeader($headerTitle); //显示表头
        //获取关键字
        $key = $_POST['key'];
        if ($_POST['search'] == 1) {
            $sql = "select * from (" . $sql1 . ") as borr ,(" . $sql2 . ") as book where borr.bookId = book.id and book.bookName like'%".$key."%' order by degree desc ";
        }elseif ($_POST['search'] == 2){
            $sql = "select * from (" . $sql1 . ") as borr , (" . $sql2 . ") as book where borr.bookId = book.id and book.bookAuthor like'%".$key."%' order by degree desc ";
        }elseif ($_POST['search'] == 3){
            $sql = "select * from (" . $sql1 . ") as borr , (" . $sql2 . ") as book where borr.bookId = book.id and book.pressName like'%".$key."%' order by degree desc ";
        }else{
            $sql = "select * from (" . $sql1 . ") as borr left join (" . $sql2 . ") as book on borr.bookId = book.id order by degree desc ";
        }
        //echo $sql;

        $paging = new page();
        $f = $paging->query($sql, 1);   //分页查询
        if ($f==-1){
            echo "<script>alert('没有数据！');</script>";
            return;
        }
        foreach ($f as $info) {   //查询数据库并遍历结果集
            $date = array("bookName" => $info['bookName'], "typeName" => $info['typeName'], "caseName" => $info['caseName'], "pressName" => $info['pressName'],
                "bookAuthor" => $info['bookAuthor'], "bookPrice" => $info['bookPrice'], "bookSum" => $info['bookSum'], "rest" => $info['rest'], "degree" => $info['degree']);
            showDate($date);    //显示数据
        }
        ?>

    </table>
</div>
<?php $paging->pageHerf(); ?>
