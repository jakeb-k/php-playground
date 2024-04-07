<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User; 
use App\Models\Task; 

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_delete_existing_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    } 

    public function test_deleting_non_existent_task_is_handled_gracefully()
    {
        $user = User::factory()->create();
        
        $nonExistentTaskId = 99999; 
        $response = $this->actingAs($user)->delete("/tasks/{$nonExistentTaskId}");

        $response->assertStatus(200); 
    }

    public function test_task_deletion_only_deletes_one()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        // Check the number of tasks before deletion
        $initialCount = Task::count();

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);

        // Check the number of tasks after deletion
        $afterDeletionCount = Task::count();

        $this->assertEquals($initialCount - 1, $afterDeletionCount);
    }

    public function test_only_valid_user_can_delete_task()
    {
        $user1 = User::factory()->create();
        
        $user2 = User::factory()->create();

        $task = Task::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);

    }




}
