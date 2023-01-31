<?php
namespace App\Traits;

use Carbon\Carbon;

trait Expires
{
    /**
     * @return void
     */
    protected static function bootExpires(): void
    {
        static::creating(function ($model) {
            $model->expired_at = Carbon::now()->add(7, 'days');
        });
    }

    /**
     * @return void
     */
    public function deactivate(): void
    {
        $this->update(['expired_at' => null]);
    }
}
