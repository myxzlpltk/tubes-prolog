<?php

class Enemy{

    private $name;
    private $diff;
    private $percentage;

    public function __construct($name, $diff, $percentage){
        $this->name = $name;
        $this->diff = $diff;
        $this->percentage = $percentage;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getDiff(){
        return $this->diff;
    }

    public function setDiff($diff): void{
        $this->diff = $diff;
    }

    public function getPercentage(){
        return $this->percentage;
    }

    public function setPercentage($percentage): void{
        $this->percentage = $percentage;
    }
}