<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class WordController extends Controller
{
    public function index()
    {
        return view('admin.words.index');
    }
}
