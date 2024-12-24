<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use Database\Factories\UserFactory;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Tạo người dùng cho từng tháng
        for ($month = 1; $month <= 12; $month++) {
            User::factory()->createdAt($month)->create();
        }
    }
}
