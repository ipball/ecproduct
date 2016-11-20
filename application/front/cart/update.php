<?php

$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "";
$url_cart = base_url() . "/cart";
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['qtyupdate'])) {
    for ($i = 0; $i < count($_POST['qtyupdate']); $i++) {
        $key = $_POST['arr_key_' . $i];
        $_SESSION[_ss . 'qty'][$key] = $_POST['qtyupdate'][$i];
    }
} else {
    $qty = isset($_POST['qty']) ? $_POST['qty'] : 0;
    if (!isset($_SESSION[_ss . 'cart'])) {
        $_SESSION[_ss . 'cart'] = array();
        $_SESSION[_ss . 'qty'][] = array();
    }
    if (in_array($item_id, $_SESSION[_ss . 'cart'])) {
        $key = array_search($item_id, $_SESSION[_ss . 'cart']);
        $_SESSION[_ss . 'qty'][$key] = $_SESSION[_ss . 'qty'][$key] + $qty;
    } else {
        array_push($_SESSION[_ss . 'cart'], $item_id);
        $key = array_search($item_id, $_SESSION[_ss . 'cart']);
        $_SESSION[_ss . 'qty'][$key] = $qty;
    }
}
header('location:' . $url_cart);
