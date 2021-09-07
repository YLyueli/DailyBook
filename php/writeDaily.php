<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    $userId = $_POST['userId'];
    $dailyname = $_POST['dailyname'];
    $dailybook = $_POST['dailybook'];
    $dailycontent = $_POST['dailycontent'];
    $num = $_POST['num'];
    $addTime = $_POST['addTime'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$dailyname){
        $responseData['code'] = 1;
        $responseData['message'] = "请输入标题";
        echo json_encode($responseData);
        exit;//后面不能继续
    }
    if(!$dailybook){
        $responseData['code'] = 2;
        $responseData['message'] = "请选择日记本";
        echo json_encode($responseData);
        exit;//后面不能继续
    }
    if(!$dailycontent){
        $responseData['code'] = 3;
        $responseData['message'] = "日记内容不能为空";
        echo json_encode($responseData);
        exit;//后面不能继续
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
    
    $sql = "INSERT INTO dailys(daily_name,dailybook_name,create_daily_time,char_number,content,user_id) VALUES ('{$dailyname}','{$dailybook}',{$addTime},{$num},'{$dailycontent}',{$userId})";

    $res = mysql_query($sql);

    if(!$res){
        $responseData['code'] = 5;
        $responseData['message'] = "添加失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "添加成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>