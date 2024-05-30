<?php

use App\Models\Settings;

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        return Settings::getValue($key, $default);
    }
}
