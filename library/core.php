<?php

function base_url() {
    return "http://localhost/ecproduct";
}

function base_path() {
    return $_SERVER['DOCUMENT_ROOT'] . "/ecproduct";
}

function salt_pass($pass) {
    //return md5("itoffside.com" . $pass);
    return $pass;
}
