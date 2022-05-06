<?php
/**
 * 读者类型管理
 * 图书类型管理
 */
?>
<link rel="stylesheet" href="../css/table.css">
<style>
    table {
        width: 30%;
        text-align: center;
    }

    table td:last-child:hover, table td:nth-child(3):hover {
        cursor: pointer;
        color: #2769a6;
    }
    a {
        width: 105px;
        margin-left: 845px;
    }
</style>
<?php
$fromId = $_GET['typeId'];    //1-读者类型管理 2-图书类型管理
$str = "";
if ($fromId == 1) {
    $str = "读者";
    ?>
    <img src="../images/readerLX.png" alt="" width="100%">
    <a href="#" onclick="window.open('../action/add.php?addId=reader','',
    'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=150')">
        添加<?php echo $str ?>类型</a>
    <?php
} elseif ($fromId == 2) {
    $str = "图书";
    ?>
    <img src="../images/bookLX.png" alt="" width="100%">
    <a href="#" onclick="window.open('../action/add.php?addId=book','',
    'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=150')">
        添加<?php echo $str ?>类型</a>
<?php } ?>


<table id="content">
    <?php
    include "../utils/tableUtil.php";
    include "../utils/sqlUtil.php";
    $headerTitle = array("编号", $str . "类型", "修改操作", "删除操作"); //设置表头
    createHeader($headerTitle); //显示表头


    $sql = "";
    if ($fromId == 1) {
        $sql = "select * from tb_loginType where id <>3";
    } elseif ($fromId == 2) {
        $sql = "select * from tb_booktype";
    }
    if ($f = query($sql)) {
        foreach ($f as $info) {
            $data = array("id" => $info['id'], "typeName" => $info['typeName'], "edit" => "修改", "del" => "删除");
            showDate($data);
        }
    }
    ?>
</table>

<script>
    /**
     * 给修改和操删除添加事件
     */
    var table = document.getElementsByTagName("table")[0];
    var set = table.rows[0].cells.length - 2;    //修改操作列下标
    var operation = table.rows[0].cells.length - 1;    //删除操作列下标

    for (let i = 1; i < table.rows.length; i++) {
        //权修改限设置
        table.rows[i].cells[set].onclick = function () {
            var id = table.rows[i].cells[0].innerHTML;
            var iLeft = (window.screen.availWidth - 30 - 300) / 2;           //获得窗口的水平位置;
            var iTop = (window.screen.height - 30 - 150) / 2;                    //获得窗口的垂直位置;

            <?php
            if ($fromId == 1){
            ?>
            window.open('../action/reset.php?from=reader&resetId=' + id + '', '', 'left=' + iLeft + ',top=' + iTop + ',width=300,height=150');
            <?php
            }else{
            ?>
            window.open('../action/reset.php?from=book&resetId=' + id + '', '', 'left=' + iLeft + ',top=' + iTop + ',width=300,height=150');
            <?php
            }
            ?>

        }
        //删除
        table.rows[i].cells[operation].onclick = function () {
            var id = table.rows[i].cells[0].innerHTML;
            var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;

            <?php
            if ($fromId == 1){
            ?>
            window.location.href = '../action/delete.php?from=reader&readerId=' + id + '';
            <?php
            }else{
            ?>
            window.location.href = '../action/delete.php?from=book&bookId=' + id + '';
            <?php
            }
            ?>
        }
    }


</script>


