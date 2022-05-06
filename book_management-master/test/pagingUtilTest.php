<?php
include "../utils/pagingUtil.php";
$t = new page();
$sql = "select * from tb_user";
$info = $t->query($sql,1);
echo $t->pageNum."<br>";
foreach ($info as $item) {
    echo $item['name'];
}
$t->pageHerf();