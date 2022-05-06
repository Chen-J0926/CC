<table>
    <?php
    /**
     * 测试tablesUtils
     */
    include "../utils/tableUtil.php";
    $col = array("1", "2", "3");
    $date = array("a", "b", "c");
    createHeader($col);
    showDate($date);
    $date = array("1", "0", "1");
    checkData($date);
    ?>
</table>