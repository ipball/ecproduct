<?php

/*
 * php code///////////**********************************************************
 */
$db = new database();
$option_im = array(
    "table" => "products",
    "fields" => "image",
    "condition" => "id='{$_GET['id']}'"
);
$query_im = $db->select($option_im);
$rs_im = $db->get($query_im);

$query = $db->delete("products", "id='{$_GET['id']}'");
if ($query == TRUE) {
    if ($rs_im['image'] != "ecimage.jpg") {
        $path = base_path() . "/upload/product/";
        @unlink($path . $rs_im['image']);
        @unlink($path . "thumb_" . $rs_im['image']);
        @unlink($path . "md_" . $rs_im['image']);
        @unlink($path . "sm_" . $rs_im['image']);
    }
    header("location:" . $baseUrl . "/back/product");
} else {
    echo "error";
}
mysql_close();
