<?php

namespace App\Nova\Traits;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;

trait LandlordTraits {
    public static function group () {
        return "LandLord";
    }


    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type != User::TYPE_LANDLORD) {
            return $query;
        }
        return $query->whereUserId(auth()->id());
    }
}
