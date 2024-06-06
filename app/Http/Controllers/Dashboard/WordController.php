<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Word;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::paginate(100);
        return view('admin.words.index', compact('words'));
    }
}
