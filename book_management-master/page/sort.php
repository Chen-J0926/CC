<?php
/**
 * 排行榜
 */
error_reporting(0);
if (!session_id()) session_start();;
if ($_SESSION['user'] == "") {
    exit();
}
/**
 * 中间内容显示
 */
?>
<link rel="stylesheet" href="../css/table.css">


<!--搜索栏-->
<div class="search">
    <form action="" method="post">
        <input type="text" name="key" placeholder="输入要查找的信息" class="sch">
        <button type="submit">快速搜索</button>
    </form>
</div>
<?php
if ($_GET['sortId'] == 1) {
    echo "<img src=\"../images/main_booksort.gif\" alt=\"\" width=\"100%\">";
}elseif ($_GET['sortId']==2){
    echo "<img src=\"../images/reader_sort.png\" alt=\"\" width=\"100%\">";
}
?>

<!--显示数据-->
<div class="content">
    <table id="content">
        <?php
        include "../utils/tableUtil.php";
        include "../utils/pagingUtil.php";
        include "../utils/pagingSql.php";
        $headerTitle = "";  //表头
        $key = $_POST['key']; //获取搜索关键字
        $sql = "";          //sql语句
        if ($_GET['sortId'] == 1) {   //图书借阅排行
            $headerTitle = array("排名", "图书名", "图书类型", "书架名称", "出版社", "作者", "价格", "可借数量", "借阅次数"); //设置表头
            $sql = "select * from (" . $sql1 . ") as borr ,(" . $sql2 . ") as book where borr.bookId = book.id and
             (book.bookName like'%" . $key . "%' or book.bookAuthor like'%" . $key . "%' ) order by degree desc ";
        }elseif ($_GET['sortId']==2){ //读者借阅排行
            $headerTitle = array("排名", "读者编号","读者姓名", "读者类型"); //设置表头
            $sql = "select * from 
(select user.*,type.typeName type from tb_user user JOIN tb_logintype type 
on user.loginTypeId = type.id and loginTypeId<> 3) as a
,
(select borr.readerId,count(readerId) as sum
from tb_user user,tb_bookborrow borr
where user.id = borr.readerId GROUP BY readerId) as b
where a.id = b.readerId 
and(name like'%" . $key . "%' or type like'%" . $key . "%' ) order by sum desc ";
        }
        createHeader($headerTitle); //显示表头

        //        echo $sql;
        $paging = new page();
        $i = 1; //排名变量
        $f = $paging->query($sql, 2);   //分页查询
        if ($f == -1) {
            echo "<script>alert('没有数据！');</script>";
            return;
        }
        $date = array();        //数据
        foreach ($f as $info) {   //查询数据库并遍历结果集
            if ($_GET['sortId']==1){
                $date = array("sort" => $i, "bookName" => $info['bookName'], "typeName" => $info['typeName'], "caseName" => $info['caseName'], "pressName" => $info['pressName'],
                    "bookAuthor" => $info['bookAuthor'], "bookPrice" => $info['bookPrice'], "rest" => $info['rest'], "degree" => $info['degree']);
            }elseif ($_GET['sortId']==2){
                $date = array("sort" => $i, "id" => $info['id'], "name" => $info['name'], "type" => $info[type]);
            }
                showDate($date);    //显示数据
            $i = $i + 1;
        }
        ?>

    </table>
</div>
<?php $paging->pageHerf(); ?>
