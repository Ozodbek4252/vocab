<?php

declare(strict_types=1);

namespace App\ViewModels\Seo;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class SeoViewModel extends BaseViewModel
{
    public int $id;
    public ?string $keywords;
    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->keywords = $this->_data->keywords;
        $this->translations = $this->getTranslations($this->_data->translations);
    }

    /**
     * Get translations from a collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    private function getTranslations(Collection $collection): array
    {
        // Group the collection by language code
        $groupedByLang = $collection->groupBy(function ($item) {
            return $item->lang->code;
        });

        // Map each group to group by column name and return only the first item
        $mapped = $groupedByLang->map(function ($group) {
            return $group->groupBy('column_name')->map->first();
        });

        // Convert the mapped collection to array
        return $mapped->toArray();
    }
}
