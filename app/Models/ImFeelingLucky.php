<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $user_id
 * @property float $number
 * @property float $sum
 * @property float $total
 * @property string $created_at
 * @property string $updated_at
 */
class ImFeelingLucky extends Model
{
    use UsesUuid;

    protected $fillable = [
        'user_id',
        'number',
        'sum',
        'total'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
