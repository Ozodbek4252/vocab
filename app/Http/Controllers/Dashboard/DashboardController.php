<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Word;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = Word::all();
        $know = Word::where('status', true)->count();
        $level = Word::select('level', DB::raw('count(*) as total'))
            ->groupBy('level')
            ->get();

        $level_names = $level->pluck('level')->toArray();
        $level_values = $level->pluck('total')->toArray();

        $stat = [
            'know' => $know,
            'dont_know' => count($words) - $know,
            'total' => count($words),
            'level' => [
                'names' => $level_names,
                'values' => $level_values,
            ],
        ];

        return view('admin.dashboard', compact('words', 'stat'));
    }
}
