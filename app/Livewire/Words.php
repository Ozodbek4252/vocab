<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Component;
use Livewire\WithPagination;

class Words extends Component
{
    use WithPagination;

    public function render()
    {
        $words = Word::paginate(50);
        $currentStartPosition = ($words->currentPage() - 1) * $words->perPage() + 1;

        return view('livewire.words', compact('words', 'currentStartPosition'));
    }
}
