<?php
if (!session_id()) session_start();;
?>
<style>
    table {
        text-align: center;
        width: 100%;
    }

    table td:last-child {
        cursor: pointer;
    }
</style>
<form action="" method="post">
    <table>
        <?php
        error_reporting(0);
        include "../utils/tableUtil.php";
        include "../utils/sqlUtil.php";
        $headerTitle = array("管理员名称", "管理员设置", "书架管理", "读者类型管理", "读者档案管理", "图书类型管理", "图书档案管理", "确认操作"); //设置表头
        createHeader($headerTitle); //显示表头

        //echo $_SESSION['actionUserId'];
        $arr_str = $_SESSION['actionUserId'];         //反序列
        $actionUserId = unserialize($arr_str);      //数组存着管理员用户在数据库中的userId
        //echo $_GET['userId'];
        $index = $_GET['userId'] - 1;                     //$actionUserId下标
//        echo $actionUserId[$index];
        $sql = "select * from tb_permission , tb_user where tb_permission.userId = tb_user.id and tb_permission.userId=" . $actionUserId[$index];
        //echo $sql;
        $f = query($sql);
        foreach ($f as $info) {   //查询数据库并遍历结果集

            $date = array("name" => $info['name'], "manager" => $info['manager'], "case" => $info['caseInfo'], "readerType" => $info['readerType'],
                "readerInfo" => $info['readerInfo'], "bookType" => $info['bookType'], "bookInfo" => $info['bookInfo'], "set" => "<input type='submit' value='确认' name='submitManager'>");
//            foreach ($date as $item) {
//                echo $item;
//            }
            checkData($date, -1);    //显示数据
        }
        ?>
    </table>
</form>

<?php
if ($_POST['submitManager']){
    $arr = array();
    for ($i=0;$i<count($headerTitle) - 2;$i++){
        $arr[$i] = 0;
        //如果选中
        $check = $_POST[check.$i];
        if($check!=""){
            $arr[$i] = 1;
        }
    }

    $sql = "update tb_permission set  manager=".$arr[0].",caseInfo=".$arr[1].",readerType=".$arr[2].",readerInfo=".$arr[3].",
     bookType=".$arr[4].",bookInfo=".$arr[5]." where userId=" . $actionUserId[$index];
//    echo $sql;
    update($sql);
    echo "<script>alert('修改成功');window.opener.location.reload();window.close();</script>";
}
?>

