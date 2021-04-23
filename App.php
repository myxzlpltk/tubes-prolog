<?php

class App{

    public $heroes;

    public function __construct(){
        $data = json_decode(file_get_contents("data.json"));

        $this->heroes = new ArrayObject();
        foreach($data as $item){
            $strongs = new ArrayObject();
            foreach($item->strongs as $enemy){
                $strongs->append(new Enemy($enemy->name, $enemy->score, $enemy->percentage));
            }

            $weaks = new ArrayObject();
            foreach($item->weaks as $enemy){
                $weaks->append(new Enemy($enemy->name, $enemy->score, $enemy->percentage));
            }

            $this->heroes->append(
                new Hero($item->name, $item->role, $item->image, $strongs, $weaks, (array)$item->stats)
            );
        }

        $this->heroes->uasort(fn($a, $b) => strcmp($a->getName(), $b->getName()));
    }

    public function validateInput($heroes){
        return is_array($heroes)
            && !empty($heroes)
            && count($heroes) <= 5
            && count($heroes) == count(array_unique($heroes))
            && empty(array_diff($heroes, array_map(fn($hero) => $hero->getName(), (array)$this->heroes)));
    }

    public function maxStats(){
        $stats = array_map(fn($hero) => $hero->getStats(), (array)$this->heroes);
        $keys = ["Movement Speed", "Physical Attack", "Magic Power", "Armor", "Magic Resistance", "Hp", "Mana", "Attack Speed", "Hp Regen", "Mana Regen", "Basic Attk Crit Rate", "Ability Crit"];
        return array_combine($keys, array_map(fn($x) => array_sum(array_column($stats, $x)), $keys));
    }

}