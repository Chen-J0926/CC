
<?php
if (!session_id()) session_start();;
/**
 * 图书馆信息
 */
include "../utils/sqlUtil.php";
$sql = "select * from tb_library";
$info = query($sql)[0];
?>
<style>
    a.hidden {
        position: absolute;
        display: none;
    }
    a.reset {
        text-decoration: none;
        margin: 5px 0 5px 0;
    }

    table.reset {

    }

</style>
<a href="#" class="reset <?php echo $_SESSION[loginTypeId]!=3? 'hidden':'' ?>"
   onclick="window.open('../action/resetLibrary.php?id=<?php echo $info[0]; ?>','','location=no,menubar=0,left='+(window.screen.availWidth-30-450)/2+',resizable=0,titlebar=0,width=450,height=300')">修改图书信息</a>
<table class="library">
    <?php
    array_shift($info); //删除第一个元素
    $title = array("图书馆：", "馆长：", "地址：", "联系电话：", "官网：");
    if ($info) {
        for ($i = 0; $i < count($title); $i++) {


            ?>
            <tr>
                <td><?php echo $title[$i]; ?></td>
                <td><?php echo $info[$i]; ?></td>
            </tr>
            <?php
        }
    } ?>

    <tr>
        <td>简介：</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;<?php echo $info['introduce'] ?></td>
    </tr>
</table>
