<?php
if (!session_id()) session_start();;
if ($_SESSION['user'] ==""){
    exit();
}

include "utils/sqlUtil.php";
$sql = "select * from tb_permission where userId = ".$_SESSION['ID'];
if(isset(query($sql)[0])){
    $info = query($sql)[0];
}

//echo $sql;

/**
 * 导航栏
 */
?>
<style>
    /* 下拉按钮样式 */
    .dropbtn {
        background-color: #306baf;
        color: white;
        padding: 14px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }
    /*.nav {*/
        /*width: 100%;*/
        /*height: 49px;*/
        /*background-color: #306baf;*/
    /*}*/
    /* 容器 <div> - 需要定位下拉内容 */
    .dropdown {
        position: relative;
        float: left;
        border-right: white solid 1px;
    }

    .dropdown:last-child {
        border: none;

    }


    /* 下拉内容 (默认隐藏) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    /* 下拉菜单的链接 */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* 鼠标移上去后修改下拉菜单链接颜色 */
    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    /* 在鼠标移上去后显示下拉菜单 */
    .dropdown:hover .dropdown-content {
        display: block;
        z-index: 1;
    }

    /* 当下拉内容显示后修改下拉按钮的背景颜色 */
    .dropdown:hover .dropbtn {
        background-color: #1f6098;
    }
    #user {
        margin-left: 500px;
        font-size: 14px;
        position: relative;
        bottom: 5px;
    }

    .dropdown-content a.hidden{
        position: absolute;
        display: none;
    }

    /*导航栏第一个鼠标经过无样式*/
    .dropdown:hover:first-child .dropbtn {
        cursor: default;
        background-color: #306baf;
    }

</style>
<div class="logo">
    <!-- <div style="height:75px;width:265px;"></div> -->
    <img src="" alt="logo" width="265" height="75">
    <span id="user"><a href="index.php" title="返回首页"><img src="images/index01.png" alt="返回首页" height="18"></a>&nbsp;&nbsp;你好&nbsp;&nbsp;<?php echo $_SESSION['user']; ?>&nbsp;&nbsp;欢迎登录！</span>
</div>
<div class="nav">
    <div class="dropdown">
        <button id="times" class="dropbtn"></button>
        <script type="text/javascript" src="js/showTime.js"></script>
    </div>
    <div class="dropdown">
        <button class="dropbtn">系统设置</button>
        <div class="dropdown-content">
            <a href="page/library.php" target="content">图书馆信息</a>
            <a href="page/management.php" target="content" class="<?php echo $info['manager']==0? "hidden":"" ?>">管理员设置</a>
            <a href="page/case.php" target="content" class="<?php echo $info['caseInfo']==0? "hidden":"" ?>">书架管理</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">读者管理</button>
        <div class="dropdown-content">
            <a href="page/type.php?typeId=1" target="content" class="<?php echo $info['readerType']==0? "hidden":"" ?>">读者类型管理</a>
            <a href="page/record.php?recordId=1" target="content" class="<?php echo $info['readerInfo']==0? "hidden":"" ?>">读者档案管理</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">图书管理</button>
        <div class="dropdown-content">
            <a href="page/type.php?typeId=2" target="content" class="<?php echo $info['bookType']==0? "hidden":"" ?>">图书类型管理</a>
            <a href="page/record.php?recordId=2" target="content" class="<?php echo $info['bookInfo']==0? "hidden":"" ?>">图书档案管理</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">图书借还</button>
        <div class="dropdown-content">
            <a href="page/bookBorrow.php" target="content">图书借阅</a>
            <a href="page/bookBack.php" target="content">图书归还</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">系统查询</button>
        <div class="dropdown-content">
            <a href="page/query.php?type=1" target="content">图书档案查询</a>
            <a href="page/query.php?type=2" target="content">图书借阅查询</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">排行榜</button>
        <div class="dropdown-content">
            <a href="page/sort.php?sortId=1" target="content">图书借阅排行榜</a>
            <a href="page/sort.php?sortId=2" target="content">读者借阅排行榜</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn" onclick="window.open('page/updatePwd.php?id=<?php echo $_SESSION[loginTypeId] ?>','content')">更改口令</button>
    </div>
    <div class="dropdown">
        <button class="dropbtn" onclick="window.open('action/exit.php','_self')">退出系统</button>
    </div>
</div>