<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Novels']);
        Category::create(['name' => 'English Course Books']);
        Category::create(['name' => 'Computer Science Books']);
        Category::create(['name' => 'Mathematics Books']);
        Category::create(['name' => 'Science Books']);
        Category::create(['name' => 'History Books']);
        Category::create(['name' => 'Biography Books']);
        Category::create(['name' => 'Religion Books']);
        Category::create(['name' => 'Health Books']);
        Category::create(['name' => 'Cooking Books']);
        Category::create(['name' => 'Travel Books']);
        Category::create(['name' => 'Children Books']);
        Category::create(['name' => 'Business Books']);
        Category::create(['name' => 'Finance Books']);
        Category::create(['name' => 'Self-Help Books']);
        Category::create(['name' => 'Romance Books']);
    }
}
