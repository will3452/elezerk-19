<?php

namespace App\Nova\Traits;

use App\Models\Room;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

trait AdminTraits {
    public static function group () {
        return "Security";
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->check() && auth()->user()->type == User::TYPE_ADMIN;
    }

    public function authorizedToDelete(Request $request) {
        return auth()->user()->type == User::TYPE_ADMIN;
    }

    public function authorizedToUpdate(Request $request) {
        return auth()->user()->type == User::TYPE_ADMIN;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == User::TYPE_ADMIN) {
            return $query;
        }
        $rooms = auth()->user()->rooms->pluck('id')->all();
        $users = Student::whereIn('room_id', $rooms)->get()->pluck('user_id')->all();
        return $query->whereIn('id', $users);
    }
}
