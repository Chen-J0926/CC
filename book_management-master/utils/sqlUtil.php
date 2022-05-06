<?php
/**
 * 查询操作
 * @param $sql
 * @return array|null
 */
function query($sql){
    $conn = new mysqli("localhost","root","123456789","jju_book") or die("连接数据库失败!");
    $conn->query("set names 'utf8'");
    $result = mysqli_query($conn, $sql);
    if (!$result){
        return -1;
    }
    $r = array();
    $i=0;
    while( $info = mysqli_fetch_array($result)){
        $r[$i] = $info;
        $i++;
    }
    mysqli_close($conn);
    return $r;
}

/**
 * 更改操作
 * 增 删 改
 * @param $sql
 */
function update($sql) {
    $conn = new mysqli("localhost","root","123","jju_book") or die("连接数据库失败!");
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}




