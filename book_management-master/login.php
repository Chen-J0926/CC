<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆系统登录</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="bg">
    <form action="action/loginOK.php" method="post">
        <label>用户名：<input type="text" name="user"></label>
        <label>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd"></label>
        &nbsp;&nbsp;<input type="radio" name="userType" value="1" checked>&nbsp;&nbsp;学生<input type="radio"
                                                                                               name="userType"
                                                                                               value="2">教师&nbsp;&nbsp;<input
                type="radio" name="userType" value="3">管理员
        <input type="submit" value="登录" class="btn">
    </form>
</div>


</body>
</html>