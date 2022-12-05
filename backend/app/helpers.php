<?php

use App\Models\Cms;

if (! function_exists('getSetting')) {
    function getSetting($key) {
        $config = Cms::where('key', $key)->first();

        return $config ? $config->value : '-';
    }
}
