<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read string $icon_path
 */
class Icon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getIconPathAttribute(): string
    {
        if (!File::exists(storage_path('app/public/' . $this->icon))) {
            return asset('assets/images/no-image.png');
        } else {
            return asset('storage/' . $this->icon);
        }
    }
}
