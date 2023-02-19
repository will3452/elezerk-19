<?php

use App\Models\Configuration;

if (! function_exists('conf')) {
    function conf ($key, $label = '') {
        $conf = Configuration::where('key', $key)->first();
        if ($label != '') {
            return $conf ? $conf->label : '-';
        }

        return $conf ? $conf->value : '-';
    }
}
