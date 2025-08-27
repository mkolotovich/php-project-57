<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('task_statuses')->insert(['name' => 'новый']);
        DB::table('task_statuses')->insert(['name' => 'в работе']);
        DB::table('task_statuses')->insert(['name' => 'на тестировании']);
        DB::table('task_statuses')->insert(['name' => 'завершен']);
    }
}
