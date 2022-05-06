<?php
/**
 * 更改口令
 */
?>
<style>
    form.hidden {
        display: none;
    }
    form input,form button{
        float: left;
        height: 30px;
        margin: 10px 0 30px 0;
        padding: 2px;
    }
    form {
        position: relative;
        left: 50%;
        margin-left: -113px;
    }
</style>
<link rel="stylesheet" href="../css/table.css">
<form action="" method="post" class="<?php echo $_GET[id]==3? '':'hidden' ?>">
    <input type="text" name="key" placeholder="输入要查找的信息" class="sch">
    <button type="submit">快速搜索</button>
    </label>
</form>
<table id="content">
    <?php
    include "../utils/tableUtil.php";
    include "../utils/sqlUtil.php";
    $key = $_POST['key'];
    $headerTitle = array("编号","用户名","密码","更改操作"); //设置表头
    createHeader($headerTitle); //显示表头
    if ($_GET[id]==3){
        $sql = "select * from tb_user where id like'%".$key."%' or name like'%".$key."%'";
    }else{
        $sql = "select * from tb_user where id=".$_GET[id];
    }
//    echo $sql;
    $info = query($sql);
    foreach ($info as $value){
        $data = array($value[id],$value[name],$value[password],"<a href='#' onclick=\"window.open('../action/reset.php?user=".$value[name]."&from=update&resetId=".$value[id]."','',
            'location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=150')\">更改口令</a>");
        showDate($data);
    }
    ?>

</table>
