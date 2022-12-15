<?php

use App\Models\Configuration;

if (! function_exists('getConfiguration')) {
    function getConfiguration($key) {
        $conf = Configuration::where('key', $key)->first();

        return $conf ? $conf->value : '-';
    }
}
