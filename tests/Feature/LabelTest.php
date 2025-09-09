<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Label;

class LabelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testCreate(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/labels/create');

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/labels', ['name' => 'bug']);

        $response->assertStatus(302);
        $label = Label::where('name', 'bug')->first();
        $this->assertEquals('bug', $label->name);
    }

    public function testIndex(): void
    {
        $response = $this->get('/labels');

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $user = User::factory()->create();

        $request = $this->actingAs($user)->post('/labels', ['name' => 'bug']);

        $response = $this->actingAs($user)->get('/labels/1/edit');

        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post('/labels', ['name' => 'bug']);
        $response = $this->patch('/labels/1', ['name' => 'feature']);

        $response->assertStatus(302);
        $label = Label::where('name', 'feature')->first();
        $this->assertEquals('feature', $label->name);
    }

    public function testDestroy(): void
    {
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post('/labels', ['name' => 'bug']);
        $response = $this->delete('/labels/1');

        $response->assertStatus(302);
        $task = Label::where('id', 1)->first();
        $this->assertNull($task);
    }
}
