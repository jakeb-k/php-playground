<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\User; 
use App\Models\Task; 

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user; 

    protected function setUp(): void {
        parent::setUp(); 
        $this->user = User::factory()->create();
    }

    #[Test]
    public function user_can_delete_existing_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    } 

    #[Test]
    public function deleting_non_existent_task_is_handled_gracefully()
    {
        $nonExistentTaskId = 99999; 

        $response = $this->actingAs($this->user)->delete("/tasks/{$nonExistentTaskId}");

        $response->assertStatus(200); 
    }

    #[Test]
    public function test_task_deletion_only_deletes_one()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);
        // Check the number of tasks before deletion
        $initialCount = Task::count();

        $response = $this->actingAs($this->user)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);

        // Check the number of tasks after deletion
        $afterDeletionCount = Task::count();

        $this->assertEquals($initialCount - 1, $afterDeletionCount);
    }

    #[Test]
    public function test_only_valid_user_can_delete_task()
    {
        
        $user2 = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($user2)->delete("/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);

    }




}
