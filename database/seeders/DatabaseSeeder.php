<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // Admin::factory()->count(2)->create();
        // Admin::factory()->create([
        //     'username' => 'chaomoinguoi',
        //     'email' => 'chaomoinguoi@gmail.com',
        //     'password' => '123456',
        // ]);
    }
}
