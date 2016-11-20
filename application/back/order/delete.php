<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$query = $db->delete("orders", "id='{$_GET['id']}'");
if($query == TRUE){
    $db->delete("order_details", "order_id='{$_GET['id']}'");
    header("location:" . $baseUrl . "/back/order");
}else{
    echo "Error!";
}
mysql_close();