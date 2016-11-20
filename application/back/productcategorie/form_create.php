<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $db = new database();
    $value_pc = array(
        "name" => trim($_POST['name']),
        "codename" => trim($_POST['codename']),
        "created" => date('Y-m-d H:i:s')
    );
    $query_pc = $db->insert("product_categories", $value_pc);

    if ($query_pc == TRUE) {
        header("location:" . $baseUrl . "/back/productcategorie");
    }
    mysql_close();
}