<?php

namespace App\Imports;

use App\Models\Word;
use Maatwebsite\Excel\Concerns\ToModel;

class WordsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $word)
    {
        if ($word[0] == 'Base Word') {
            return null;
        }

        $duplicated = Word::where('word', $word[0])->first();
        if ($duplicated) {
            $duplicated = true;
        } else {
            $duplicated = false;
        }

        return new Word([
            'word' => $word[0],
            'guide_word' => $word[1],
            'level' => $word[2],
            'type' => $word[3],
            'duplicated' => $duplicated
        ]);
    }
}
