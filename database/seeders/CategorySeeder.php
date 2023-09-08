<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// 创建 几个 新 分类
        DB::table('categories')->insert([
            [
                'name'  =>  'Holidays',
                'slug'  =>  'holidays',
                'created_at'  =>  now(),
                'updated_at'  => now(),
            ],

            [
                'name'  =>  'Camping',
                'slug'  =>  'camping',
                'created_at'  =>  now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
