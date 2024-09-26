<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// Create a new user
        User::factory()->create([
            'name'  =>  'Frank Zhang',
            'email'  =>  'Blog.Laravel10@qq.com',
            'password'  =>  bcrypt('password'),
        ]);
    }
}
