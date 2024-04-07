<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task; 

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * User can create a task
     */
    public function test_update_existing_task_content()
    {
        $user = User::factory()->create(); 
        $task = Task::factory()->create(['user_id'=> $user->id]); 

        $updatedData = [
            'task' => 'Updated Task',
            'priority' => 3,
            'due_date'=>now()->addDays(7),
        ];
        $response = $this->actingAs($user)->put("/tasks/{$task->id}", $updatedData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', ['id' => $task->id] + $updatedData);
    }

    public function test_handle_non_existent_task_properly(){
        $user = User::factory()->create(); 
        $nonExistentTaskId = 99999; 
        $updatedData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated task description',
            'priority' => 2,
        ];
    
        $response = $this->actingAs($user)->put("/tasks/{$nonExistentTaskId}", $updatedData);
    
        $response->assertStatus(302); 
        $this->assertDatabaseMissing('tasks', $updatedData);
    }

    public function test_updating_task_priority_and_check_order()
    {
        $user = User::factory()->create();
        $taskOne = Task::factory()->create(['user_id' => $user->id, 'priority' => 1]);
        $taskTwo = Task::factory()->create(['user_id' => $user->id, 'priority' => 2]);

        
        $updatedData = [
            'task' => 'Updated Task',
            'priority' => 3,
            'due_date'=>now()->addDays(7),
        ];

        $this->actingAs($user)->put("/tasks/{$taskOne->id}", $updatedData);

        $updatedTaskOne = Task::find($taskOne->id);
        $updatedTaskTwo = Task::find($taskTwo->id);
  
        $this->assertTrue($updatedTaskOne->priority > $updatedTaskTwo->priority);
    }

    public function test_updating_task_with_invalid_data_fails()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
    
        $updatedData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated task description',
            'priority' => 'invalid' 
        ];
    
        $response = $this->actingAs($user)->put("/tasks/{$task->id}", $updatedData);
    
        $response->assertStatus(302); 
        $this->assertDatabaseMissing('tasks', ['id' => $task->id] + $updatedData);
    }
    
    public function test_only_valid_user_can_update_task(){
        $user1 = User::factory()->create(); 
        $user2 = User::factory()->create(); 

        $task= Task::factory()->create(['user_id' => $user1->id]);

        $updatedData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated task description',
            'priority' => 2,
        ];
    
        $response = $this->actingAs($user2)->put("/tasks/{$task->id}", $updatedData);
    
        $response->assertStatus(302); 
        $this->assertDatabaseMissing('tasks', $updatedData);
    }
 
}
