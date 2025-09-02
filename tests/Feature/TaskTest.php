<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_create(): void
    {   
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tasks/create');

        $response->assertStatus(200);
    }

    public function test_show(): void
    {   
        $user = User::factory()->create();

        $request = $this->actingAs($user)->post('/tasks', ['name' => 'new', 'status_id' => 1, 'created_by_id' => 1]);
    
        $response = $this->actingAs($user)->get('/tasks/1/edit');

        $response->assertStatus(200);
    }

    public function test_store(): void
    {   
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/tasks', ['name' => 'new', 'status_id' => 1, 'created_by_id' => 1]);

        $response->assertStatus(302);
        $task = Task::where('name', 'new')->first();
        $this->assertEquals('new', $task->name);
    }

    public function test_index(): void
    {   
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_edit(): void
    {   
        $user = User::factory()->create();

        $request = $this->actingAs($user)->post('/tasks', ['name' => 'new', 'status_id' => 1, 'created_by_id' => 1]);
    
        $response = $this->actingAs($user)->get('/tasks/1/edit');

        $response->assertStatus(200);
    }

    public function test_update(): void
    {   
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post('/tasks', ['name' => 'new', 'status_id' => 1, 'created_by_id' => 1]);
        $response = $this->patch('/tasks/1', ['name' => 'in work', 'status_id' => 1, 'created_by_id' => 1]);

        $response->assertStatus(302);
        $task = Task::where('name', 'in work')->first();
        $this->assertEquals('in work', $task->name);
    }

    public function test_destroy(): void
    {   
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post('/tasks', ['name' => 'new', 'status_id' => 1, 'created_by_id' => 1]);
        $response = $this->delete('/tasks/1');

        $response->assertStatus(302);
        $task = Task::where('id', 1)->first();
        $this->assertNull($task);
    }
}
