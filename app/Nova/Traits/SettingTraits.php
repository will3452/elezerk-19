<?php

namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;


trait SettingTraits {

    public static function availableForNavigation(Request $request)
    {
        return $request->user()->type == User::TYPE_ADMIN;
    }
}
