<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use App\Classes\Quiz; 
use App\Classes\Question; 

class QuizTest extends TestCase
{
  #[Test]
  public function it_consists_of_questions(){
    
    $quiz = new Quiz();

    $quiz->addQuestion(new Question("what is 2 + 2?", 4));

    $this->assertCount(1, $quiz->questions()); 
  }

  #[Test]
  public function it_grades_perfect_quiz(){
    $quiz = new Quiz();

    $quiz->addQuestion(new Question("what is 2 + 2?", 4));

    //Take the quiz
    $question = $quiz->nextQuestion();

    $question->answer(4); 

    //Grade the quiz
    $this->assertEquals(100, $quiz->grade()); 
  }

  #[Test]
  public function it_grades_failed_quiz(){
    $quiz = new Quiz();

    $quiz->addQuestion(new Question("what is 2 + 2?", 4));

    //Take the quiz
    $question = $quiz->nextQuestion();

    $question->answer('incorrect answer'); 

    //Grade the quiz
    $this->assertEquals(0, $quiz->grade()); 
  }

  #[Test]
  public function it_cannot_be_graded_if_not_completed(){
    $quiz = new Quiz(); 
    $quiz->addQuestion(new Question('What is 1+1', 2));
    $quiz->addQuestion(new Question('What is 2+2', 4));

    $question = $quiz->nextQuestion();
    $question->answer(2);

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Error: Quiz has not been completed');

    $quiz->grade(); 
  }

  #[Test]
  public function it_can_be_graded_if_its_completed(){
    $quiz = new Quiz(); 
    $quiz->addQuestion(new Question('What is 1+1', 2));
    $quiz->addQuestion(new Question('What is 2+2', 4));
    
    $question = $quiz->nextQuestion();
    $question->answer(2);
    $question = $quiz->nextQuestion();
    $question->answer(4);

    

    $this->assertEquals(100, $quiz->grade()); 
  }

  #[Test]
  public function it_can_be_checked_if_its_completed(){
    $quiz = new Quiz(); 
    $quiz->addQuestion(new Question('What is 1+1', 2));
    $quiz->addQuestion(new Question('What is 2+2', 4));

    $question = $quiz->nextQuestion();
    $question->answer(2);

    $this->assertEquals(false, $quiz->isCompleted()); 
  }

  #[Test]
  public function it_can_be_checked_if_its_not_completed(){
    $quiz = new Quiz(); 
    $quiz->addQuestion(new Question('What is 1+1', 2));
    $quiz->addQuestion(new Question('What is 2+2', 4));
    
    $question = $quiz->nextQuestion();
    $question->answer(2);
    $question = $quiz->nextQuestion();
    $question->answer(4);

    $this->assertEquals(true, $quiz->isCompleted()); 
  }

  #[Test]
  public function it_correctly_tracks_the_next_question(){
    $quiz = new Quiz(); 
    $quiz->addQuestion(new Question('What is 1+1', 2));
    $quiz->addQuestion(new Question('What is 2+2', 4));

    $question = $quiz->nextQuestion();
    $question = $quiz->nextQuestion();

    $this->assertEquals(2, $quiz->index); 

  }
}
