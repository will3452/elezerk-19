<?php

namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

trait SettingTraits {
    public static function group () {
        return "Setting";
    }

    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == User::TYPE_ADMIN;
    }
}
