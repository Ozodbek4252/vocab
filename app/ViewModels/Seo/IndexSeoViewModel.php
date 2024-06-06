<?php

declare(strict_types=1);

namespace App\ViewModels\Seo;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexSeoViewModel extends BaseViewModel
{
    public ?int $id;
    public ?string $keywords;
    public ?array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data?->id;
        $this->keywords = $this->_data?->keywords;

        if (isset($this->_data?->translations)) {
            $this->translations = $this->getTranslations($this->_data?->translations);
        }
    }

    private function getTranslations(Collection $collection): array
    {
        $collection = $collection->filter(function ($item) {
            return $item->lang->code == env('LOCALE', 'uz');
        });

        $collection = $collection->groupBy('column_name');

        $collection = $collection->map(function ($item) {
            return $item[0];
        });

        return $collection->toArray();
    }
}
