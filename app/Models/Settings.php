<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];
    public static function getValue($key, $default = null)
    {
        $setting = self::where('name', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
