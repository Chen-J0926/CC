<?php
error_reporting(0);
/**
 * 图书归还
 */
?>
<link rel="stylesheet" href="../css/table.css">
<style>
    form {
        width: 236px;
        position: relative;
        left: 50%;
        margin-left: -168px;
    }

    form input:nth-child(1) {
        float: left;
        height: 25px;
    }

    form label {
        display: block;
        position: absolute;
        width: 236px;
        margin-top: 5px;
    }
    table#content {
        width: 892px;
        margin: 37px 0 0 26px;
    }
</style>

<img src="../images/bookgh.gif" alt="图书借阅" width="100%">
<div style="background-image: url('../images/subBG.jpg'); background-repeat:no-repeat;background-size:100% 100%; height: calc(100% - 42px);%">
    <form action="" method="post">
        <input type="text" name="id" class="sch">
        <input type="submit" name="submit" value="快速查询"><br>
        <label><input type="radio" name="type" value="1" checked> 读者编号
        <input type="radio" name="type" value="2"> 图书编号</label>

    </form>

    <table id="content">
        <?php
        include "../utils/sqlUtil.php";
        include "../utils/tableUtil.php";
        $headerTitle = array("读者编号", "读者姓名", "图书编号", "图书名称", "借阅日期", "最迟还书日期", "操作");  //创建表头
        createHeader($headerTitle);
        $borr = "select borr.*,user.name,book.bookName from tb_bookborrow borr,tb_book book,tb_user user where borr.readerId=user.id 
and borr.bookId=book.id and borr.returnFlag=0";     //默认
        //        echo $borr;

        //查询读者是否已经借书达到最大数量
        if ($_POST['submit']) {
            if ($_POST[type]==1){
                $borr = "select borr.*,user.name,book.bookName from tb_bookborrow borr,tb_book book,tb_user user where borr.readerId=user.id 
and borr.bookId=book.id and borr.returnFlag=0 and borr.readerId=".$_POST[id];
            }elseif($_POST[type]==2){
                $borr = "select borr.*,user.name,book.bookName from tb_bookborrow borr,tb_book book,tb_user user where borr.readerId=user.id 
and borr.bookId=book.id and borr.returnFlag=0 and borr.bookId=".$_POST[id];
            }
        }

        $borrInfo = query($borr);
        foreach ($borrInfo as $item) {
            $date = array($item['readerId'], $item['name'], $item['bookId'], $item['bookName'], $item['borrowData'], $item['returnData'], "<input type='button' value='归还' 
onclick='window.open("."../action/bookBack.php?readerId={$item['readerId']}&bookId={$item['bookId']},_self".")'>");
            showDate($date);
        }
        ?>

    </table>
</div>


