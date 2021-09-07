<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $addTime = $_POST['addTime'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$username){
        $responseData['code'] = 1;
        $responseData['message'] = "用户名不能为空";
        echo json_encode($responseData);
        exit;//后面不能继续
    }
    if(!$password){
        $responseData['code'] = 2;
        $responseData['message'] = "密码不能为空";
        echo json_encode($responseData);
        exit;
    }
    
    // 连接数据库
    $link = mysql_connect("localhost","root","yl1223");
    // 判断是否连接成功
    if(!$link){
        $responseData['code'] = 3;
        $responseData['message'] = "数据库连接失败";

        echo json_encode($responseData);
        exit;
    }
    // 设置字符集
    mysql_set_charset("utf8");
    // 选择数据库
    mysql_select_db("daily");
    // 准备SQL语句,验证用户名是否重名
    $sql1 = "SELECT * FROM user WHERE username='{$username}'";
    // 发送SQL语句
    $res = mysql_query($sql1);
    // 取出一行数据
    $row = mysql_fetch_assoc($res);
    if($row){
        // 用户名重名
        $responseData['code'] = 4;
        $responseData['message'] = "用户名已存在";

        echo json_encode($responseData);
        exit;
    }

    // md5加密规则
    $str = md5(md5(md5($password)."xxx")."yyy");

    $sql2 = "INSERT INTO user(username,password,create_time) VALUES ('{$username}','{$str}',{$addTime})";

    $res = mysql_query($sql2);

    if(!$res){
        $responseData['code'] = 5;
        $responseData['message'] = "注册失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "注册成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>