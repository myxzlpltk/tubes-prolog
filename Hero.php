<?php

class Hero{

    private $name;
    private $role;
    private $image;
    private $enemies;
    private $stats;

    public function __construct($name, $role, $image, $enemies, $stats){
        $this->name = $name;
        $this->role = $role;
        $this->image = $image;
        $this->enemies = $enemies;
        $this->stats = $stats;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role): void{
        $this->role = $role;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image): void{
        $this->image = $image;
    }

    public function getEnemies(){
        return $this->enemies;
    }

    public function setEnemies($enemies): void{
        $this->enemies = $enemies;
    }

    public function getStats(){
        return $this->stats;
    }

    public function setStats($stats): void{
        $this->stats = $stats;
    }

}