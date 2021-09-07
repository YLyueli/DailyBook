<?php
    header('content-type:text/html;charset="utf-8"');
    
    // 连接数据库
    $link = mysql_connect("localhost","root","yl1223");
    // 判断是否连接成功
    if(!$link){
        echo "数据库连接失败";
        exit;
    }
    // 设置字符集
    mysql_set_charset("utf8");
    // 选择数据库
    mysql_select_db("yyy");
    // 准备SQL语句,验证用户名是否重名
    $sql = "SELECT * FROM users";
    // 发送SQL语句
    $res = mysql_query($sql);

    $arr  = array();
    while($row = mysql_fetch_assoc($res)){
        array_push($arr, $row);
    }

    echo json_encode($arr);
    
    mysql_close($link);

?>