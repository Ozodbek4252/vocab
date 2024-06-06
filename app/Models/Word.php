<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $word
 * @property string $guide_word
 * @property string $level
 * @property string $type
 * @property string $status
 * @property bool $duplicated
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'guide_word',
        'level',
        'type',
        'status',
        'duplicated'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
