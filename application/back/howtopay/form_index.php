<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new database();
    $value_py = array(
        "detail" => trim($_POST['detail']),
        "created" => date('Y-m-d H:i:s')
    );
    $query_py = $db->update("contents", $value_py, "codename='howtopay'");

    if ($query_py == TRUE) {
        $_SESSION[_ss . 'msg_result'] = TRUE;
        header("location:" . $baseUrl . "/back/howtopay");
    }
    mysql_close();
}