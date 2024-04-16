<?php

namespace App\Classes;
use App\Classes\Question; 

class Quiz
{
    protected array $questions;

    public int $index = 0; 

    public function questions(){
        return $this->questions; 
    }

    public function nextQuestion(){
        $question = $this->questions[$this->index];
        $this->index ++; 
        
        return $question; 
    }

    public function addQuestion(Question $question){
        $this->questions[] = $question; 
    }
    
    public function grade() {

        if(!$this->isCompleted()){
            throw new \Exception('Error: Quiz has not been completed'); 
        }
        return count($this->correctlyAnsweredQuestions()) / count($this->questions) * 100; 
    }

    protected function correctlyAnsweredQuestions(){
        return array_filter($this->questions, 
            fn($question) => $question->isCorrect()
        );
    }

    public function isCompleted(){
        $answeredQuestionCount = count(array_filter($this->questions, 
        fn($question) => $question->answer != null
        ));

        return $answeredQuestionCount === count($this->questions); 
    }
}
