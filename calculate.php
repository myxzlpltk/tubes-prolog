<?php

include "bootstrap.php";

$heroes = $_GET['heroes'];

if(!$app->validateInput($heroes)){
    echo "Input tidak valid";
    http_response_code(403);
    exit();
}