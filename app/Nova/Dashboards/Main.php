<?php

namespace App\Nova\Dashboards;

use App\Models\User;
use App\Nova\Metrics\AvailableRooms;
use App\Nova\Metrics\PendingBookings;
use App\Nova\Metrics\TotalRooms;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            PendingBookings::make()->canSee(fn () => auth()->user()->type == User::TYPE_LANDLORD),
            AvailableRooms::make()->canSee(fn () => auth()->user()->type == User::TYPE_LANDLORD),
            TotalRooms::make()->canSee(fn () => auth()->user()->type == User::TYPE_LANDLORD),
        ];
    }
}
