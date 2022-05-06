<?php
/**
 * 图书书架
 */
?>
<style>
    table {
        width: 30%;
        text-align: center;
    }
    table td:last-child:hover, table td:nth-child(3):hover {
        cursor: pointer;
        color: #2769a6;
    }
</style>
<a href="#" onclick="window.open('../action/add.php?addId=case','',
    'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=150')">
    添加书架</a>

<table>
    <?php
    include "../utils/tableUtil.php";
    include "../utils/sqlUtil.php";
    $headerTitle = array("编号", "书架名", "修改操作","删除操作"); //设置表头
    createHeader($headerTitle); //显示表头

    $sql = "select * from tb_case";
    if ($f = query($sql)) {
        foreach ($f as $info){
            $data = array("id" => $info['id'], "caseName" => $info['caseName'],"edit"=>"修改","del"=>"删除");
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
    var operation = table.rows[0].cells.length -1;    //删除操作列下标

    for (let i = 1; i < table.rows.length; i++) {
        //权修改限设置
        table.rows[i].cells[set].onclick = function () {
            var id = table.rows[i].cells[0].innerHTML;
            var iLeft = (window.screen.availWidth - 30 - 300) / 2;           //获得窗口的水平位置;
            var iTop = (window.screen.height-30-150)/2;                    //获得窗口的垂直位置;
            window.open('../action/reset.php?from=case&resetId=' + id + '', '', 'left=' + iLeft + ',top='+iTop+',width=300,height=150');
        }
        //删除
        table.rows[i].cells[operation].onclick = function () {
            var id = table.rows[i].cells[0].innerHTML;
            var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;
            window.location.href = '../action/delete.php?from=case&caseId=' + id + '';
        }
    }



</script>

