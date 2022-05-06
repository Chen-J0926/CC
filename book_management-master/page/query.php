<?php
error_reporting(0);
if (!session_id()) session_start();;

if ($_SESSION['user'] == "") {
    exit();
}
$type = $_GET["type"];    //获取type，用于判断是系统查询中的哪个模块
/**
 * 系统查询
 */
?>
<link rel="stylesheet" href="../css/table.css">
<!--搜索栏-->
<div class="search">
    <form action="" method="post">
        <input type="text" name="key" placeholder="输入要查找的信息" class="sch">
        <button type="submit" name="submit">快速搜索</button>
    </form>
</div>
<?php
if ($type == 1){
    echo "<img src='../images/dangan.gif' width='100%'>";
}elseif ($type == 2){
    echo "<img src='../images/bookborrow.gif' width='100%'>";
}

?>
<!--显示数据-->
<div class="content">
    <table id="content">
        <?php
        include "../utils/tableUtil.php";
        include "../utils/sqlUtil.php";
        include "../utils/pagingSql.php";

        $str = $_POST['key'];
//        echo $str;

        if ($type == 1) {
            $headerTitle = array( "图书名", "图书类型", "书架名称", "出版社", "作者", "价格", "库存量", "可借数量"); //设置表头

            $sql = "select * from (" . $sql1 . ") as borr join (" . $sql2 . ") as book on borr.bookId = book.id and 
(bookName like '%" . $str . "%' or typeName like'%" . $str . "%' or caseName like'%" . $str . "%' or pressName like'%" . $str . "%' or bookAuthor like'%" . $str . "%')";
        }elseif($type == 2){
            $headerTitle = array("图书名", "图书类型", "书架名称", "借阅者","借阅日期","归还日期","状态"); //设置表头

            $sql = "select * from (" . $sql3 . ") as borr , (" . $sql4 . ") as book where borr.id = book.bookId 
            and (bookName like '%" . $str . "%' or typeName like'%" . $str . "%' or caseName like'%" . $str . "%' or name like'%" . $str . "%')";
        }
//        echo $sql;
        createHeader($headerTitle); //显示表头

        $f = query($sql);   //分页查询
        foreach ($f as $info) {   //查询数据库并遍历结果集
            if ($type == 1) {   //图书档案查询
                $date = array("bookName" => $info['bookName'], "typeName" => $info['typeName'], "caseName" => $info['caseName'], "pressName" => $info['pressName'],
                    "bookAuthor" => $info['bookAuthor'], "bookPrice" => $info['bookPrice'], "bookSum" => $info['bookSum'], "rest" => $info['rest']);
            }else{
                $flag = $info[returnFlag]==1? "已归还":"未归还";
                $date = array("bookName" => $info['bookName'], "typeName" => $info['typeName'], "caseName" => $info['caseName'],
                    "reader"=>$info['name'],"borrowDate"=>$info[borrowData],"backDate"=>$info[returnData],"flag"=>$flag);
            }
            showDate($date);    //显示数据
        }
        ?>
    </table>
</div>
