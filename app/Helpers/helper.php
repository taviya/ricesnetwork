<?php

use App\Models\Settings;

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        return Settings::getValue($key, $default);
    }
}


if (!function_exists('shortText')) {
    function shortText($txHash)
    {
        // Check if the transaction hash is long enough
        if (strlen($txHash) >= 16) {
            $start = substr($txHash, 0, 8);
            $end = substr($txHash, -8);
            $shortenedTxHash = $start . '...' . $end;
        } else {
            $shortenedTxHash = $txHash;
        }
        return $shortenedTxHash; // Output the shortened transaction hash
    }
}