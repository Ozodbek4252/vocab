<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $keywords
 * @property string $translations->title
 * @property string $translations->description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 */
class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'keywords',
    ];

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
