<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Seed the default categories for SolveHub.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Programming', 'description' => 'General programming concepts, algorithms, and data structures', 'icon' => 'code'],
            ['name' => 'Web Development', 'description' => 'Frontend, backend, and full-stack web development', 'icon' => 'language'],
            ['name' => 'DBMS', 'description' => 'Database management systems, SQL, NoSQL, and data modeling', 'icon' => 'database'],
            ['name' => 'AI/ML', 'description' => 'Artificial intelligence, machine learning, and deep learning', 'icon' => 'psychology'],
            ['name' => 'Mathematics', 'description' => 'Discrete math, linear algebra, calculus, and statistics', 'icon' => 'calculate'],
            ['name' => 'Career Guidance', 'description' => 'Career advice, interview prep, and professional development', 'icon' => 'work'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'icon' => $cat['icon'],
            ]);
        }
    }
}
