<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $slug
 * @property string $size // in bytes
 * @property int $page
 * @property string $extension
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read string $formatted_size
 * @property-read string $full_path
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'slug',
        'size',
        'page',
        'extension',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFullPathAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
