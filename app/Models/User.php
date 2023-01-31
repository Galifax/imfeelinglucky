<?php

namespace App\Models;

use App\Interfaces\LinkableInterface;
use App\Traits\Expires;
use App\Traits\Linkable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $id
 * @property string $username
 * @property string $token
 * @property ImFeelingLucky[] imFeelingLuckies
 * @property string $expired_at
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable implements LinkableInterface
{
    use UsesUuid, Expires, Linkable;

    protected $appends = [
        'link'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phonenumber',
        'token',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * @return string
     */
    public function getLinkAttribute(): string
    {
        return $this->createLink();
    }

    /**
     * @return HasMany
     */
    public function imFeelingLuckies(): HasMany
    {
        return $this->hasMany(ImFeelingLucky::class);
    }

    public function routeName(): string
    {
        return 'user.show';
    }
}
