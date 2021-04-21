<?php

class App{

    public $heroes;

    public function __construct(){
        $data = json_decode(file_get_contents("data.json"));

        $this->heroes = new ArrayObject();
        foreach($data as $item){
            $this->heroes->append(
                new Hero($item->name, $item->role, $item->image)
            );
        }

        $this->heroes->uasort(fn($a, $b) => strcmp($a->getName(), $b->getName()));
    }
}