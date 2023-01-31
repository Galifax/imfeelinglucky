<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Linkable
{
    /**
     * @return void
     */
    protected static function bootLinkable(): void
    {
        static::creating(function ($model) {
            $model->token = self::generateToken();
        });
    }

    /**
     * @return string
     */
    public function createLink(): string
    {
        return route($this->routeName(), ['user' => $this->token]);
    }

    /**
     * @return string
     */
    public function setNewToken(): string
    {
        $token = $this->generateToken();
        $this->update(['token' => self::generateToken()]);
        return $token;
    }

    /**
     * @return string
     */
    public static function generateToken(): string
    {
        return Str::random(60);
    }
}
