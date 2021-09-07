<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");
    // 取出传过来的数据
    // var_dump($_POST);
    
    $dailybookId = $_POST['dailybookId'];
    $bookname = $_POST['bookname'];
    $booklabel = $_POST['booklabel'];
    // 简单的表单验证，前台页面会验证用户密码，但是数据并不一定会传输到后台
    if(!$bookname){
        $responseData['code'] = 1;
        $responseData['message'] = "请输入日记名";
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
    
    $sql = "UPDATE dailybook SET book_name='{$bookname}',label='{$booklabel}' WHERE id={$dailybookId}";
    
    $res = mysql_query($sql);

    if(!$res){
        $responseData['code'] = 5;
        $responseData['message'] = "添加失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['code'] = 0;
        $responseData['message'] = "修改成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>