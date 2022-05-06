<?php
/**
 * 分页查询
 */
class page{
//    var $totalNum;  //显示记录数
    var $pageNo ;   //当前页号
    var $pageNum;   //记录总共有多少页

    /**
     * @return mixed
     */
    public function getPageNo()
    {
        return $this->pageNo;
    }

    /**
     * @param mixed $pageNo
     */
    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;
    }


    /**
     * 分页查询
     * @param $sql          不好限制的sql语句
     * @param $totalNum     显示记录条数
     * @return array|null   结果集数组
     */
    function query($sql,$totalNum){
        include "sqlUtil.php";
        $totalSum = count(query($sql));    //计算二维数组长度，其长度就是数据的记录条数
        $this->pageNum = ceil($totalSum/$totalNum);
        if (isset($_GET['pageNo']) && $_GET['pageNo']>0){   //存在且大于0
            $this->setPageNo($_GET['pageNo']);
        }else{                                          //小于最小页号1
            $this->setPageNo(1);
        }
        if ($this->getPageNo()>$this->pageNum){     //超过总页数
            $this->setPageNo($this->pageNum);
        }
//        echo $_GET['pageNo']."<br>";
        $sql = $sql." limit ".($this->getPageNo()-1)*$totalNum." , ".$totalNum; //添加limit，限制查询
//        echo $sql."<br>";
        return query($sql);
    }

    function pageHerf(){
        echo "<a href='?pageNo=1'>首页</a>";
        echo "<a href='?pageNo=".($this->getPageNo()-1)."'>上一页</a>";
        echo $this->pageNo."/".$this->pageNum;
        echo "<a href='?pageNo=".($this->getPageNo()+1)."'>下一页</a>";
        echo "<a href='?pageNo=".$this->pageNum."'>末页</a>";
    }
}

//$t = new page();
//$sql = "select * from tb_user";
//$info = $t->query($sql,1);
//echo $t->pageNum."<br>";
//foreach ($info as $item) {
//    echo $item['name'];
//}
//$t->pageHerf();

