<?php
namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UsesUuid
{
    /**
     * @return void
     */
    protected static function bootUsesUuid(): void
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid6();
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
