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

        $response = $this->actingAs($user)->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $newLabel = 'bug';
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('labels.store'), ['name' => $newLabel]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('labels', ['name' => $newLabel,]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post(route('labels.store'), ['name' => 'bug']);
        $request->assertSessionHasNoErrors();
        $label = Label::first();
        $response = $this->actingAs($user)->get(route('labels.edit', $label->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $updatedLabel = 'feature';
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post(route('labels.store'), ['name' => 'bug']);
        $request->assertSessionHasNoErrors();
        $label = Label::first();
        $response = $this->patch(route('labels.update', $label), ['name' => $updatedLabel]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('labels', ['name' => $updatedLabel,]);
    }

    public function testDestroy(): void
    {
        $user = User::factory()->create();
        $request = $this->actingAs($user)->post(route('labels.store'), ['name' => 'bug']);
        $label = Label::first();
        $response = $this->delete(route('labels.destroy', $label->id));
        $response->assertStatus(302);
        $removedLabel = Label::first();
        $this->assertNull($removedLabel);
    }
}
