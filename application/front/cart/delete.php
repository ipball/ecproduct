<?php

$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "";
if (!isset($_SESSION[_ss . 'cart'])) {
    $_SESSION[_ss . 'cart'] = array();
    $_SESSION[_ss . 'qty'] = array();
}
$key = array_search($item_id, $_SESSION[_ss . 'cart']);
$_SESSION[_ss . 'qty'][$key] = "";
$_SESSION[_ss . 'cart'] = array_diff($_SESSION[_ss . 'cart'], array($item_id));
header('location:' . base_url() . '/cart');
