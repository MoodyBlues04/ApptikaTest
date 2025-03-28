<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property int $app_id
 * @property Carbon $date
 * @property int $position
 * @property string $created_at
 * @property string $updated_at
 */
class TopAppHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'app_id',
        'date',
        'position',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];
}
