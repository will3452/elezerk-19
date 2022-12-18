<?php

namespace App\Nova\Dashboards;

use App\Models\User;
use App\Nova\Metrics\Bids;
use App\Nova\Metrics\Users;
use App\Nova\Metrics\Events;
use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\Documents;
use App\Nova\Metrics\Announcements;
use Elezerk\Calendar\Calendar;
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
            Users::make()->canSee(fn () => auth()->user()->type == User::TYPE_ADMIN),
            Announcements::make(),
            Events::make(),
            Documents::make()->canSee(fn () => auth()->user()->type == User::TYPE_ADMIN),
            Bids::make(),
        ];
    }
}
