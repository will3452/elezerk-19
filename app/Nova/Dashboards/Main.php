<?php

namespace App\Nova\Dashboards;

use App\Models\User;
use App\Nova\Metrics\Users;
use App\Nova\Metrics\MyBalance;
use App\Nova\Metrics\PendingBookings;
use Laravel\Nova\Dashboards\Main as MainDashboard;

class Main extends MainDashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            PendingBookings::make()->canSee(fn () => auth()->user()->type == User::TYPE_OWNER),
            MyBalance::make()->canSee(fn () => auth()->user()->type == User::TYPE_OWNER),
            Users::make()->canSee(fn () => auth()->user()->type == User::TYPE_ADMIN),
        ];
    }
}
