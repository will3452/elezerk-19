<?php

use App\Models\Variable;

if (! function_exists('getVariable')) {
    function getVariable($key, $default = '') {
        $var = Variable::where('key', $key)->first();

        return $var ? $var->value : $default;
    }
}
