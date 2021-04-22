<?php

class Hero{

    private $name;
    private $role;
    private $image;
    private $strongs;
    private $weaks;

    public function __construct($name, $role, $image, $strongs, $weaks){
        $this->name = $name;
        $this->role = $role;
        $this->image = $image;
        $this->strongs = $strongs;
        $this->weaks = $weaks;
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

    public function getStrongs(){
        return $this->strongs;
    }

    public function setStrongs($strongs): void{
        $this->strongs = $strongs;
    }

    public function getWeaks(){
        return $this->weaks;
    }

    public function setWeaks($weaks): void{
        $this->weaks = $weaks;
    }

}