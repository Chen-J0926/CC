<?php
if (!session_id()) session_start();;

if ($_SESSION['user'] == "") {
    exit();
}
/**
 * 管理员权限
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
<img src="../images/manager.png" alt="" width="100%">
<!--显示数据-->
<div class="content">
    <a href="#" onclick="window.open('../action/addUser.php?loginType=<?php echo $_SESSION[loginTypeId]; ?>','',
            'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=300')"
       style="margin-left: 850px">添加管理员</a>
    <table id="content">
        <?php
        include "../utils/tableUtil.php";
        include "../utils/sqlUtil.php";
        $headerTitle = array("管理员名称", "管理员设置", "书架管理", "读者类型管理", "读者档案管理", "图书类型管理", "图书档案管理", "设置", "操作"); //设置表头
        createHeader($headerTitle); //显示表头
        $actionUserId = array();    //存放用户id
        $i = 0;                     //$actionUserId下标

        $sql = "select * from tb_permission , tb_user where tb_permission.userId = tb_user.id " ;
//        echo $sql;
        $f = query($sql);
        foreach ($f as $info) {   //查询数据库并遍历结果集
            $actionUserId[$i] = $info['userId'];
            $i++;

            $date = array("name" => $info['name'], "manager" => $info['manager'], "case" => $info['caseInfo'], "readerType" => $info['readerType'],
                "readerInfo" => $info['readerInfo'], "bookType" => $info['bookType'], "bookInfo" => $info['bookInfo'], "set" => "权限设置", "del" => "删除");
//            foreach ($date as $item) {
//                echo $item;
//            }
            checkData($date,-2);    //显示数据
        }
        $actionUserId_str = serialize($actionUserId);   //序列化数组
        $_SESSION['actionUserId'] = $actionUserId_str;
//        echo $_SESSION['actionUserId'];
        ?>
    </table>
</div>

<!--引用权限设置和操作列添加事件文件-->
<script type="text/javascript" src="../js/managerReactor.js"></script>