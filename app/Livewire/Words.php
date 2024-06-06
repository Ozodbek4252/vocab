<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Component;
use Livewire\WithPagination;

class Words extends Component
{
    use WithPagination;

    public $with_duplicate = true;

    public function render()
    {
        if ($this->with_duplicate) {
            $words = Word::paginate(50);
        } else {
            $words = Word::where('duplicated', false)->paginate(50);
        }
        $currentStartPosition = ($words->currentPage() - 1) * $words->perPage() + 1;

        return view('livewire.words', compact('words', 'currentStartPosition'));
    }

    public function filterDuplicate()
    {
        $this->with_duplicate = !$this->with_duplicate;

        $this->render();
    }
}
