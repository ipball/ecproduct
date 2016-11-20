<?php

session_start();
/*
 * include file start
 */
require 'library/core.php';
require 'library/cons.php';
require 'library/database.php';
require 'library/security.php';
require 'library/thaidate.php';

$baseUrl = base_url();
$basePath = base_path();

$onpage = isset($_GET['onpage']) ? $_GET['onpage'] : "front";
$url = isset($_GET['url']) ? $_GET['url'] : "home";
$a = isset($_GET['a']) ? $_GET['a'] : "index";

/*
 * logical programming
 */
if ($onpage == "back" AND $a != "login") {
    $security = new security();
    $security->check("admin");
}

if (file_exists("application/" . $onpage . "/" . $url . "/" . $a . ".php")) {
    require ("application/" . $onpage . "/" . $url . "/" . $a . ".php");
} else {
    header('location:' . $baseUrl);
}
