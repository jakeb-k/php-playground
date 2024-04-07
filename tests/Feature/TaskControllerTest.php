<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TaskControllerTest extends TestCase

{
    use RefreshDatabase, WithFaker;
    /**
     * User can create a task
     */
    public function test_user_can_create_task_with_required_fields()
    {
        $user = User::factory()->create();
        $taskData = [
            'task' => 'New Task',
            'due_date' => now()->addDays(2),
            'priority' => 1, 
            'user_id' => $user->id 
        ];

        $response = $this->actingAs($user)->post('/tasks', $taskData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', $taskData);
    }
    /**
     * Task cannot be created with missing fields
     */
    public function test_user_cannot_create_task_with_missing_fields(){
        $user = User::factory()->create();

        $invalidTask = [
            'task' => 'Invalid task',
        ];

        $response = $this->actingAs($user)->post('/tasks', $invalidTask);

        //redirect back to create form
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['due_date', 'priority']);
    }
    /**
     * Task cannot be created with invalid fields
     */
    public function test_user_cannot_create_task_with_invalid_fields(){
        $user = User::factory()->create();

        $invalidTask = [
            'task' => 'Invalid task',
            'due_date' => 24,
            'priority' => 'abc', 
            'user_id' => $user->id 
        ];

        $response = $this->actingAs($user)->post('/tasks', $invalidTask);

        //redirect back to create form
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['due_date', 'priority']);
    }

    /**
     * Task can be created when priority levels are valid
     */
    public function test_task_creation_succeeds_with_valid_priority_levels(){
        $user = User::factory()->create();

        $validPriorities = [1,2,3];

        foreach($validPriorities as $priority){
            $taskData = [
                'task' => 'Task with priority level '.$priority,
                'priority'=> $priority,
                'due_date' => now()->addDays(2),
            ];
            $response = $this->actingAs($user)->post('/tasks', $taskData); 
            $response->assertStatus(302);

            $this->assertDatabaseHas('tasks', $taskData);
        }
    }
    /**
     * Task cannot be created when priority levels are invalid
     */
    public function test_task_creation_fails_with_invalid_priority_levels(){
        $user = User::factory()->create();

        $invalidPriorities = [-1,0,4];

        foreach($invalidPriorities as $priority){
            $invalidData = [
                'task' => 'Task with priority level '.$priority,
                'priority'=> $priority,
                'due_date' => now()->addDays(2),
            ];
            $response = $this->actingAs($user)->post('/tasks', $invalidData); 
            $response->assertStatus(302);

            $this->assertDatabaseMissing('tasks', $invalidData);
        }
    }
}
