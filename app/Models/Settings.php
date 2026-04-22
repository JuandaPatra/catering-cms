<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    public static function get($key, $default = null)
    {
    return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
            return optional(
                self::where('key', $key)->first()
        )->value ?? $default;
        });
    }

    public static function set($key, $value)
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        cache()->forget("setting_{$key}");
    }
}
