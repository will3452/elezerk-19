<?php

use App\Models\Variable;

if (function_exists('website')) {
    function getVariable($key) {
        $var = Variable::where('key', $key)->first();

        return $var ? $var : '';
    }
}
