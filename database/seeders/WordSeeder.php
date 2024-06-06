<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Word::create([
                'word' => fake()->word,
                'level' => 'A1',
                'type' => 'noun',
                'status' => 'I know',
            ]);
        }
    }
}
