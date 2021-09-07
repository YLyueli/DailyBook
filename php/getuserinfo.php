<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    $id = $_GET['id'];


    if(!$id){
        $responseData['code'] = 1;
        $responseData['message'] = "数据不存在";

        echo json_encode($responseData);
        exit;
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
    
    // 准备SQL语句
    $sql = "SELECT * FROM user WHERE id={$id}";
    // 发送SQL语句
    $res = mysql_query($sql);
    // 取数据
    $row = mysql_fetch_assoc($res);
    if(!$row){
        echo($row);
        $responseData['code'] = 3;
        $responseData['message'] = "数据不存在";
        echo json_encode($responseData);
    } else {
        $responseData['message'] = json_encode($row);
        echo json_encode($responseData);
    }

    mysql_close($link);

?>