<?php

require(base_path() . "/library/uploadimg.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new database();
    if (checkimg() == TRUE) {
        $filename = date('YmdHis') . rand(0, 9);
        $type = end(explode(".", $_FILES["image"]["name"]));
        $image = $filename . "." . $type;

        $path = base_path() . "/upload/product/";
        uploadimg($filename, 600, 600, $path);
        uploadimg("thumb_" . $filename, 400, 400, $path);
        uploadimg("md_" . $filename, 150, 150, $path);
        uploadimg("sm_" . $filename, 70, 70, $path);
    } else {
        $image = "ecimage.jpg";
    }
    $value_pd = array(
        "name" => trim($_POST['name']),
        "price" => trim($_POST['price']),
        "brandname" => trim($_POST['brandname']),
        "detail" => trim($_POST['detail']),
        "created" => date('Y-m-d H:i:s'),
        "image" => $image,
        "product_categorie_id" => trim($_POST['product_categorie_id'])
    );
    $query_pd = $db->insert("products", $value_pd);

    if ($query_pd == TRUE) {
        header("location:" . $baseUrl . "/back/product");
    }
    mysql_close();
}