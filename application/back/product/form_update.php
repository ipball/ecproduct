<?php

require(base_path() . "/library/uploadimg.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new database();
    $option_im = array(
        "table" => "products",
        "fields" => "image",
        "condition" => "id='{$_POST['id']}'"
    );
    $query_im = $db->select($option_im);
    $rs_im = $db->get($query_im);
    if (checkimg() == TRUE) {
        $filename = date('YmdHis') . rand(0, 9);
        $type = end(explode(".", $_FILES["image"]["name"]));
        $image = $filename . "." . $type;

        $path = base_path() . "/upload/product/";
        uploadimg($filename, 600, 600, $path);
        uploadimg("thumb_" . $filename, 400, 400, $path);
        uploadimg("md_" . $filename, 150, 150, $path);
        uploadimg("sm_" . $filename, 70, 70, $path);

        if ($rs_im['image'] != "ecimage.jpg") {
            @unlink($path . $rs_im['image']);
            @unlink($path . "thumb_" . $rs_im['image']);
            @unlink($path . "md_" . $rs_im['image']);
            @unlink($path . "sm_" . $rs_im['image']);
        }
    } else {
        $image = $rs_im['image'];
    }

    $value_pd = array(
        "name" => trim($_POST['name']),
        "price" => trim($_POST['price']),
        "brandname" => trim($_POST['brandname']),
        "detail" => trim($_POST['detail']),
        "image" => $image,
        "product_categorie_id" => trim($_POST['product_categorie_id'])
    );
    $query_pd = $db->update("products", $value_pd, "id='{$_POST['id']}'");

    if ($query_pd == TRUE) {
        header("location:" . $baseUrl . "/back/product");
    }
    mysql_close();
}