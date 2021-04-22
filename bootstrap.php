<?php

include "App.php";
include "Enemy.php";
include "Hero.php";

$app = new App();

function e($str){
    return htmlspecialchars($str);
}