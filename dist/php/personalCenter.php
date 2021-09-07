<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    $username = $_POST['user_nicename'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $special = $_POST['special'];
    $id = $_POST['id'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$username){
        $responseData['code'] = 1;
        $responseData['message'] = "用户名不能为空";
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
    // 判断师傅重名
    $sql1 = "SELECT * FROM user WHERE username='{$username}'";
    // 发送SQL语句
    $res1 = mysql_query($sql1);
    // 取出一行数据
    $row1 = mysql_fetch_assoc($res1);
    if($row1){
        // 用户名重名
        $responseData['code'] = 3;
        $responseData['message'] = "用户名已存在";

        echo json_encode($responseData);
        exit;
    }
    // 准备SQL语句,修改密码
    $sql2 = "UPDATE user SET username='{$username}',sex={$sex},birthday='{$birthday}',special='{$special}' WHERE id={$id}";
    // 发送sql语句

    $res2 = mysql_query($sql2);

    if(!$res2){
        $responseData['code'] = 4;
        $responseData['message'] = "数据修改失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "数据修改成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>