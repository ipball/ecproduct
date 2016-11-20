<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new database();
    $value_pc = array(
        "name" => trim($_POST['name']),
        "codename" => trim($_POST['codename'])
    );
    $query_pc = $db->update("product_categories", $value_pc, "id='{$_POST['id']}'");

    if ($query_pc == TRUE) {
        header("location:" . $baseUrl . "/back/productcategorie");
    }
    mysql_close();
}