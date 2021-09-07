<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$password1){
        $responseData['code'] = 1;
        $responseData['message'] = "新密码不能为空";
        echo json_encode($responseData);
        exit;
    }
    if(!$password2){
        $responseData['code'] = 2;
        $responseData['message'] = "请再次输入密码";
        echo json_encode($responseData);
        exit;
    }
    if($password1 != $password2){
        $responseData['code'] = 3;
        $responseData['message'] = "两次密码输入不一致";
        echo json_encode($responseData);
        exit;
    }
    
    // 连接数据库
    $link = mysql_connect("localhost","root","yl1223");
    // 判断是否连接成功
    if(!$link){
        $responseData['code'] = 4;
        $responseData['message'] = "数据库连接失败";

        echo json_encode($responseData);
        exit;
    }
    // 设置字符集
    mysql_set_charset("utf8");
    // 选择数据库
    mysql_select_db("daily");
    // md5加密规则
    $str = md5(md5(md5($password1)."xxx")."yyy");
    // 准备SQL语句,修改密码
    $sql = "UPDATE user SET password='{$str}' WHERE username='{$username}'";
    // 发送sql语句
    $res = mysql_query($sql);
 
    if(!$res){
        $responseData['code'] = 5;
        $responseData['message'] = "密码修改失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "密码修改成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>