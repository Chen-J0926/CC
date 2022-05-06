<?php
/**
 * 图书借阅
 * 图书续借
 */
?>
<link rel="stylesheet" href="../css/table.css">
<img src="../images/bookborr.gif" alt="图书借阅" width="100%">
<style>
    form {
        position: relative;
        width: 590px;
        left: 50%;
        margin-left: -295px;
        top: 10px;
    }

    table#content {
        width: 892px;
        margin: 37px 0 0 26px;
    }

</style>
<div style="background-image: url('../images/subBG.jpg'); background-repeat:no-repeat;background-size:100% 100%; height: calc(100% - 42px);%">
    <form action="../action/bookBorrOk.php" method="post">
        借阅者编号：<input type="text" name="readerId">
        图书编号：<input type="text" name="bookId">
        <input type="submit" name="submit" value="完成借阅" class="btn">
    </form>

    <table id="content">
        <?php
        include "../utils/sqlUtil.php";
        include "../utils/tableUtil.php";
        $headerTitle = array("读者编号", "读者姓名", "图书编号", "图书名称", "借阅日期", "最迟还书日期", "操作");  //创建表头
        createHeader($headerTitle);
        $borr = "select borr.*,user.name,book.bookName from tb_bookborrow borr,tb_book book,tb_user user where borr.readerId=user.id and borr.bookId=book.id and borr.returnFlag=0";
        //        echo $borr;
        $borrInfo = query($borr);
        foreach ($borrInfo as $item) {
            $date = array($item['readerId'], $item['name'], $item['bookId'], $item['bookName'], $item['borrowData'], $item['returnData'], "<input type='button' value='续借' 
onclick='window.open("."../action/bookXJ.php?readerId={$item['readerId']}&bookId={$item['bookId']},_self".")'>");
            showDate($date);
        }

        ?>
    </table>
</div>


