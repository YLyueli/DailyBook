<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    $userId = $_POST['userId'];
    $bookname = $_POST['bookname'];
    $booklabel = $_POST['booklabel'];
    $addTime = $_POST['addTime'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$bookname){
        $responseData['code'] = 1;
        $responseData['message'] = "名称不能为空";
        echo json_encode($responseData);
        exit;//后面不能继续
    }
    
    // 连接数据库
    $link = mysql_connect("localhost","root","yl1223");
    // 判断是否连接成功
    if(!$link){
        $responseData['code'] = 2;
        $responseData['message'] = "数据库连接失败";

        echo json_encode($responseData);
        exit;
    }
    // 设置字符集
    mysql_set_charset("utf8");
    // 选择数据库
    mysql_select_db("daily");
    // 准备SQL语句,验证是否重名
    $sql1 = "SELECT * FROM dailybook WHERE book_name='{$bookname}'";
    // 发送SQL语句
    $res1 = mysql_query($sql1);
    // 取出一行数据
    $row1 = mysql_fetch_assoc($res1);
    if($row1){
        // 用户名重名
        $responseData['code'] = 3;
        $responseData['message'] = "日记本已存在";
        echo json_encode($responseData);
        exit;
    }  

    $sql2 = "INSERT INTO dailybook(book_name,label,create_book_time,user_id) VALUES ('{$bookname}','{$booklabel}',{$addTime},{$userId})";

    $res2 = mysql_query($sql2);

    if(!$res2){
        $responseData['code'] = 4;
        $responseData['message'] = "添加失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "注册成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>