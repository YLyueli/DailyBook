<?php
    header('content-type:text/html;charset="utf-8"');
    /* 1、连接数据库 
        第一个参数：连接数据库的IP或域名
        第二个参数：用户名
        第三个参数：密码 */
    $link = mysql_connect("localhost","root","yl1223");
    /* 2、判断数据库是否连接成功
        exit//终止最后的所有代码操作 */
    if(!$link){
        echo "连接失败";
        exit;
    }
    // 3、设置字符集
    mysql_set_charset("utf8");
    // 4、选择数据库
    mysql_select_db("daily");
    // 5、准备sql语句
    $sql1 = "SELECT * FROM dailys";
    $sql2 = "SELECT COUNT(*) AS dailynum FROM dailys";
    $sql3 = "SELECT COUNT(*) AS dailybooknum FROM dailybook";
    $sql4 = "SELECT SUM(char_number) AS dailycharnum FROM dailys";
    // 6、发送sql语句
    $res1 = mysql_query($sql1);//输出结果：resource(3) of type (mysql result)
    $res2 = mysql_query($sql2);
    $res3 = mysql_query($sql3);
    $res4 = mysql_query($sql4);

    $arr = array();
    // 7、处理结果，执行几次取出第几个数据
    while($row1 = mysql_fetch_assoc($res1)){
        array_push($arr, $row1);
    }
    $row2 = mysql_fetch_assoc($res2);
    $row3 = mysql_fetch_assoc($res3);
    $row4 = mysql_fetch_assoc($res4);
    array_push($arr, $row2);
    array_push($arr, $row3);
    array_push($arr, $row4);
    
    echo json_encode($arr);

    // 8、关闭数据库bh
    mysql_close($link);

?>


