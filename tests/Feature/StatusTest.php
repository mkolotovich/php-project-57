<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskStatus;

class StatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_create(): void
    {   
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/task_statuses/create');

        $response->assertStatus(200);
    }

    public function test_store(): void
    {   
        $response = $this->post('/task_statuses', ['name' => 'in work']);

        $response->assertStatus(302);
        $status = TaskStatus::where('name', 'in work')->first();
        $this->assertEquals('in work', $status->name);
    }

    public function test_index(): void
    {   
        $this->seed();
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);
        $status = TaskStatus::where('name', 'новый')->first();
        $this->assertEquals('новый', $status->name);
    }

    public function test_edit(): void
    {   
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/task_statuses/1/edit');

        $response->assertStatus(200);
    }

    public function test_update(): void
    {   
        $this->seed();
        $response = $this->patch('/task_statuses/1', ['name' => 'in work']);

        $response->assertStatus(302);
        $status = TaskStatus::where('name', 'in work')->first();
        $this->assertEquals('in work', $status->name);
    }

    public function test_destroy(): void
    {   
        $this->seed();
        $response = $this->delete('/task_statuses/1');

        $response->assertStatus(302);
        $status = TaskStatus::where('id', 1)->first();
        $this->assertNull($status);
    }
}
