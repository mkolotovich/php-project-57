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

    public function testCreate(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/task_statuses/create');

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->post('/task_statuses', ['name' => 'in work']);

        $response->assertStatus(302);
        $status = TaskStatus::where('name', 'in work')->first();
        $this->assertEquals('in work', $status->name);
    }

    public function testIndex(): void
    {
        $this->seed();
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);
        $status = TaskStatus::where('name', 'новый')->first();
        $this->assertEquals('новый', $status->name);
    }

    public function testEdit(): void
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/task_statuses/1/edit');

        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $this->seed();
        $response = $this->patch('/task_statuses/1', ['name' => 'in work']);

        $response->assertStatus(302);
        $status = TaskStatus::where('name', 'in work')->first();
        $this->assertEquals('in work', $status->name);
    }

    public function testDestroy(): void
    {
        $this->seed();
        $response = $this->delete('/task_statuses/1');

        $response->assertStatus(302);
        $status = TaskStatus::where('id', 1)->first();
        $this->assertNull($status);
    }
}
