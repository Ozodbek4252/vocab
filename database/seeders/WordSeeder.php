<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WordsImport;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Excel::import(new WordsImport, public_path('vocab.xlsx'));
    }
}
