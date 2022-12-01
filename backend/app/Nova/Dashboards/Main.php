<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\_4PS;
use App\Nova\Metrics\Announcements;
use App\Nova\Metrics\Blotters;
use App\Nova\Metrics\Complaints;
use App\Nova\Metrics\Feedback;
use App\Nova\Metrics\Gender;
use App\Nova\Metrics\Households;
use App\Nova\Metrics\Residents;
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
            Residents::make(),
            Households::make(),
            Gender::make(),
            _4PS::make(),
            Complaints::make(),
            Feedback::make(),
            Blotters::make(),
            Announcements::make(),
        ];
    }
}
