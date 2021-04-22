<?php

include "bootstrap.php";

$names = array_map(fn($hero) => $hero->getName(), (array)$app->heroes);

$txt = new ArrayObject();
foreach($app->heroes as $hero){
    foreach($hero->getStrongs() as $enemy){
        if(!in_array($enemy->getName(), $names)){
            echo "Something wrong: {$hero->getName()} {$enemy->getName()}";
            exit;
        }
        $txt->append("strong(\"{$hero->getName()}\", \"{$enemy->getName()}\", {$enemy->getScore()}, {$enemy->getPercentage()})");
    }

    foreach($hero->getWeaks() as $enemy){
        if(!in_array($enemy->getName(), $names)){
            echo "Something wrong: {$hero->getName()} {$enemy->getName()}";
            exit;
        }
        $txt->append("weak(\"{$hero->getName()}\", \"{$enemy->getName()}\", {$enemy->getScore()}, {$enemy->getPercentage()})");
    }
}

$data = implode("\n", (array)$txt);
file_put_contents("rule.txt", $data);
echo nl2br($data);
