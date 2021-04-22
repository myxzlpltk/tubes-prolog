<?php

class Enemy{

    private $name;
    private $score;
    private $percentage;

    public function __construct($name, $score, $percentage){
        $this->name = $name;
        $this->score = $score;
        $this->percentage = $percentage;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getScore(){
        return $this->score;
    }

    public function setScore($score): void{
        $this->score = $score;
    }

    public function getPercentage(){
        return $this->percentage;
    }

    public function setPercentage($percentage): void{
        $this->percentage = $percentage;
    }
}