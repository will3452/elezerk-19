<?php

use App\Models\Configuration;

if (! function_exists('conf')) {
    function conf ($key) {
        $conf = Configuration::where('key', $key)->first();
        return $conf ? $conf->value : '-';
    }
}
