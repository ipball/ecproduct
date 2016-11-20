<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$query = $db->delete("product_categories", "id='{$_GET['id']}'");
if($query == TRUE){
    header("location:" . $baseUrl . "/back/productcategorie");
}else{
    echo "Error! You are not delete product in this categorie.";
}
mysql_close();