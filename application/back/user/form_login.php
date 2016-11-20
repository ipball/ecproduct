<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new database();
    $password = salt_pass($_POST['password']);
    $option_pw = array(
        "table" => "users",
        "fields" => "id,username,user_type",
        "condition" => "username='{$_POST['username']}' AND password='{$password}'"
    );
    $query_pw = $db->select($option_pw);
    $rows_pw = $db->rows($query_pw);
    if ($rows_pw == 1) {
        $rs_pw = $db->get($query_pw);
        $_SESSION[_ss . 'username'] = $rs_pw['username'];
        $_SESSION[_ss . 'id'] = $rs_pw['id'];
        $_SESSION[_ss . 'levelaccess'] = $rs_pw['user_type'];
        header('location:'.$baseUrl.'/back/home/index');
    }else{
        header('location:'.$baseUrl.'/back/user/login');
    }
    mysql_close();
}