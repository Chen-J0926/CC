<?php
error_reporting(0);
/**
 * 图书档案管理
 * 读者档案管理
 */
if (!session_id()) session_start();;
if ($_SESSION['user'] == "") {
    exit();
}
$recordId = $_GET['recordId'];    //1-读者档案    2-图书档案
?>
<link rel="stylesheet" href="../css/table.css">


<!--搜索栏-->
<div class="search">
    <form action="" method="post">
        <input type="text" name="key" placeholder="输入要查找的信息" class="sch">
        <button type="submit" >搜索</button>
    </form>
</div>
<?php
if ($recordId==1){
    echo "<img src=\"../images/redaerRecord.png\" alt=\"\" width=\"100%\">";
    echo "<a href=\"#\" onclick=\"window.open('../action/addUser.php?loginType=1','',
        'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=300')\"
   style=\"margin-left: 850px\">添加读者</a>";
}elseif ($recordId==2){
    echo "<img src=\"../images/bookRecord.png\" alt=\"\" width=\"100%\">";
    echo "<a href=\"#\" onclick=\"window.open('../action/addBook.php','',
        'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=300')\"
   style=\"margin-left: 850px\">添加图书</a>";
}
?>


<!--显示数据-->
<div class="content">
    <table id="content">
        <?php
        include "../utils/tableUtil.php";
        include "../utils/sqlUtil.php";
        include "../utils/pagingSql.php";
        $key = $_POST['key']; //获取搜索关键字
        $headerTitle = "";
        $sql = "";
        if ($recordId==1){
            $headerTitle = array("读者编号","读者姓名", "读者类型",  "修改操作","删除操作"); //设置表头
            $sql = "select user.*,type.typeName from tb_user as user, tb_loginType as type where user.loginTypeId=type.id and type.id <>3 
and (name like '%".$key."%' or typeName like '%".$key."%')";
        }elseif ($recordId==2){
            $headerTitle = array("图书编号", "图书名称", "图书类型", "书架名称", "出版社", "作者", "价格", "库存量", "修改操作","删除操作"); //设置表头
            $sql = "select * from tb_stock as borr , (" . $sql2 . ") as book where borr.bookId = book.id  and 
            ( bookName like '%".$key."%' or typeName like '%".$key."%' or caseName like '%".$key."%' or pressName like '%".$key."%' )";
        }
        createHeader($headerTitle); //显示表头
//        echo $sql2;
        $f = query($sql);   //查询
        $date = array();
        foreach ($f as $info) {   //查询数据库并遍历结果集
            if ($recordId==1){
                $date = array("readerId"=>$info['id'],"readerName" => $info['name'], "readerType" => $info['typeName'], "reset"=>"修改","del"=>"删除");
            }elseif ($recordId==2){
                $date = array("bookId"=>$info['id'],"bookName" => $info['bookName'], "typeName" => $info['typeName'], "caseName" => $info['caseName'], "pressName" => $info['pressName'],
                    "bookAuthor" => $info['bookAuthor'], "bookPrice" => $info['bookPrice'], "bookSum" => $info['bookSum'], "reset"=>"修改","del"=>"删除");
            }
            showDate($date);    //显示数据
        }
        ?>

    </table>
</div>
<!--引用修改，删除项添加事件文件-->
<script type="text/javascript" src="../js/tableEvent.js"></script>

