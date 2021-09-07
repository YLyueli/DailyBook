<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    $id = $_GET['id'];
    
    // 连接数据库
    $link = mysql_connect("localhost","root","yl1223");
    // 判断是否连接成功
    if(!$link){
        $responseData['code'] = 1;
        $responseData['message'] = "数据库连接失败";

        echo json_encode($responseData);
        exit;
    }
    // 设置字符集
    mysql_set_charset("utf8");
    // 选择数据库
    mysql_select_db("yyy");
    
    // 准备SQL语句
    $sql1 = "DELETE FROM users WHERE id={$id}";
    // 发送SQL语句
    $res = mysql_query($sql1);

    if(!$res){
        // 用户名重名
        $responseData['code'] = 2;
        $responseData['message'] = "数据删除失败";

        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "数据删除成功";
        echo json_encode($responseData);
    }
    mysql_close($link);

?>