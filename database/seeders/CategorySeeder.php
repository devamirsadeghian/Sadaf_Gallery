<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'title' => 'شمع',
                'photo' => 'null',
                'parent_id' => 0,
            ],
            [
                'title' => 'سنگ مصنوعی',
                'photo' => 'null',
                'parent_id' => 0,
            ],
            [
                'title' => 'قالب',
                'photo' => 'null',
                'parent_id' => 0,
            ],
        ]);
    }
}
