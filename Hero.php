<?php

class Hero{

    private $name;
    private $role;
    private $image;

    public function __construct($name, $role, $image){
        $this->name = $name;
        $this->role = $role;
        $this->image = $image;
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

}