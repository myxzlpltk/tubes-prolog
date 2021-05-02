<?php

class App{

    public $heroes;

    public function __construct(){
        $data = json_decode(file_get_contents("data.json"));

        $this->heroes = new ArrayObject();
        foreach($data as $item){
            $enemies = new ArrayObject();
            foreach($item->enemies as $enemy){
                $enemies->append(new Enemy($enemy->name, $enemy->diff, $enemy->percentage));
            }

            $this->heroes->append(
                new Hero($item->name, $item->role, $item->image, $enemies, (array)$item->stats)
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
        $keys = ["Movement Speed", "Physical Attack", "Magic Power", "Armor", "Magic Resistance", "Hp", "Mana", "Attack Speed", "Hp Regen", "Mana Regen", "Basic Attk Crit Rate", "Ability Crit Rate"];
        return array_combine($keys, array_map(fn($x) => max(array_column($stats, $x) ?: [1]), $keys));
    }

}