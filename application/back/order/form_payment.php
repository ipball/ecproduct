<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pay_date_explode = explode("/", trim($_POST['pay_date']));
    $pay_date = $pay_date_explode[2] . "-" . $pay_date_explode[1] . "-" . $pay_date_explode[0] . " " . trim($_POST['pay_time']);
    $db = new database();
    $value_pm = array(
        "pay_money" => trim($_POST['pay_money']),
        "pay_date" => $pay_date,
        "detail" => trim($_POST['detail']),
        "order_id" => $_POST['order_id']
    );
    $query_pm = $db->insert("payments", $value_pm);

    if ($query_pm == TRUE) {
        $db->update("orders", array("order_status"=>"payments"),"id='{$_POST['order_id']}'");
        header("location:" . $baseUrl . "/back/order");
    }
    mysql_close();
}