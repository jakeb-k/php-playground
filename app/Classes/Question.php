<?php

namespace App\Classes;

class Question
{
    public $answer;

    protected $correct; 

    public function __construct($body, $solution){
        $this->body = $body; 
        $this->solution = $solution; 
    }

    public function answer($answer){
    
        $this->answer = $answer; 
        return $this->correct = $answer === $this->solution; 
   }
   public function isCorrect(){
        return $this->correct; 
   }
}
