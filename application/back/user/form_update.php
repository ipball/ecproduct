<?php
$db = new database();
$value_user = array(
    "firstname" => trim($_POST['firstname']),
    "lastname" => trim($_POST['lastname']),
    "username" => trim($_POST['username']),
    "email" => trim($_POST['email']),
    "phone" => trim($_POST['phone']),
    "address" => trim($_POST['address']),
    "district" => trim($_POST['district']),
    "province" => trim($_POST['province']),
    "postcode" => trim($_POST['postcode']),
    "user_type" => trim($_POST['user_type'])
);
$con_user = "id='{$_GET['id']}'";
$query_user = $db->update("users", $value_user, $con_user);

if($query_user == TRUE){
    header("location:" . $baseUrl . "/back/user");
}
mysql_close();