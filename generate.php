<?php

include "bootstrap.php";

$names = array_map(fn($hero) => $hero->getName(), (array)$app->heroes);

$txt = new ArrayObject();
foreach($app->heroes as $hero){
    $txt->append("hero(\"{$hero->getName()}\").");
    foreach($hero->getEnemies() as $enemy){
        if(!in_array($enemy->getName(), $names)){
            echo "Something wrong: {$hero->getName()} {$enemy->getName()}";
            exit;
        }
        $txt->append("win(\"{$hero->getName()}\", \"{$enemy->getName()}\", {$enemy->getDiff()}, {$enemy->getPercentage()}).");
    }
}

$data = implode("\n", (array)$txt);
file_put_contents("rule.txt", $data);
echo "Total rule : ";
echo count($txt);
echo " ";
echo count($names)**2 == count($txt) ? "MATCH" : "UNMATCH";
