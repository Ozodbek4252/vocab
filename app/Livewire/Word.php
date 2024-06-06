<?php

namespace App\Livewire;

use App\Models\Word as ModelsWord;
use Livewire\Component;

class Word extends Component
{
    public ModelsWord $word;
    public $count;

    public function mount(ModelsWord $word, $count = 1, $key = null)
    {
        $this->word = $word;
        $this->count = $count;
    }

    public function render()
    {
        $word = $this->word;
        return view('livewire.word', compact('word'));
    }

    public function changeStatus($status)
    {
        $this->word->update(['status' => $status]);

        toastr(trans('body.Updated successfully'));
    }
}
