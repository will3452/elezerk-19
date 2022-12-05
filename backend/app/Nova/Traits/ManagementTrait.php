<?php
namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;

/**
 *
 */
trait ManagementTrait
{
    public static function group() {
        return "Management";
    }


    public static function availableForNavigation(Request $request)
    {
        $allowed = [User::TYPE_ADMIN, User::TYPE_CLERK];
        return in_array(auth()->user()->type, $allowed);
    }
}
