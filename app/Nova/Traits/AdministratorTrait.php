<?php

namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;


trait AdministratorTrait {

    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == User::TYPE_ADMIN;
    }
}
