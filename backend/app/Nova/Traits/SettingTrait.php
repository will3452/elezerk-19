<?php
namespace App\Nova\Traits;

use App\Models\User;
use Illuminate\Http\Request;

/**
 *
 */
trait SettingTrait
{
    public static function group() {
        return "settings";
    }

    public static function availableForNavigation(Request $request)
    {
        $allowed = [User::TYPE_ADMIN];
        return in_array(auth()->user()->type, $allowed);
    }

}
