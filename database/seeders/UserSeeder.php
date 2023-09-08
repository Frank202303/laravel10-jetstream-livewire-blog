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
        /// 创建 一个 新 用户
        User::factory()->create([
            'name'  =>  'Frank Zhang',
            'email'  =>  'Blog.Laravel10@qq.com',
            'password'  =>  bcrypt('password'),
        ]);
    }
}
