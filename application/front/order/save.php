<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new database();
    $value_or = array(
        "order_date" => date('Y-m-d H:i:s'),
        "total" => $_POST['total'],
        "user_id" => 2,
        "fullname" => trim($_POST['fullname']),
        "email" => trim($_POST['email']),
        "phone" => trim($_POST['phone']),
        "address" => trim($_POST['address']),
        "district" => trim($_POST['district']),
        "province" => trim($_POST['province']),
        "postcode" => trim($_POST['postcode'])
    );
    $query_or = $db->insert("orders", $value_or);
    $order_id = $db->insert_id();
    if ($query_or == TRUE) {
        for ($i = 0; $i < $_POST['count_item']; $i++) {
            $value_od = array(
                "order_id" => $order_id,
                "product_id" => $_POST['product_' . $i],
                "quantity" => $_POST['qty_' . $i],
                "price" => $_POST['price_' . $i]
            );
            $db->insert("order_details", $value_od);
        }
        unset($_SESSION[_ss . 'cart']);
        unset($_SESSION[_ss . 'qty']);
        $_SESSION[_ss . 'mform'] = "itoffside.com";
        $_SESSION[_ss . 'order_id'] = $order_id;
        header("location:" . base_url() . "/order/success");
    }
}