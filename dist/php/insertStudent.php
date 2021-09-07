<?php
    header('content-type:text/html;charset="utf-8"');
    //统一返回格式
    $responseData = array("code" => 0, "message" => "");

    // var_dump($_POST);
    $name = $_POST['name'];
    $chinese = $_POST['chinese'];
    $english = $_POST['english'];
    $math = $_POST['math'];

    $link = mysql_connect("localhost","root","yl1223");
    if(!$link){
        $responseData['code'] = 1;
        $responseData['message'] = "数据库连接失败";

        echo json_encode($responseData);
        exit;
    }

    mysql_set_charset("utf8");

    mysql_select_db("yyy");

    $sql = "INSERT INTO student(name,chinese,english,math) VALUES ('{$name}',{$chinese},{$english},{$math})";

    $res = mysql_query($sql);

    if(!$res){
        $responseData['code'] = 2;
        $responseData['message'] = "数据插入失败";
        echo json_encode($responseData);
        exit;
    } else {
        $responseData['message'] = "数据插入成功";
        echo json_encode($responseData);
    }

    mysql_close($link);

?>