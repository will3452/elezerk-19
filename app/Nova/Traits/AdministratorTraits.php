<?php

namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait AdministratorTraits
{
    public static function authorizedToCreate(Request $request)
    {

        return auth()->check() && $request->user()->type == User::TYPE_ADMIN;
    }

    public function authorizedToDelete(Request $request) {
        return $request->user()->type == User::TYPE_ADMIN;
    }

    public function authorizedToUpdate(Request $request) {
        return $request->user()->type == User::TYPE_ADMIN;
    }

}
