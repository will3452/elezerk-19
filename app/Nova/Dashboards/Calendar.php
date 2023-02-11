<?php

namespace App\Nova\Dashboards;

use App\Models\Event;
use Elezerk\Calendarjs\Calendarjs;
use Laravel\Nova\Dashboard;

class Calendar extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            Calendarjs::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'calendar';
    }
}
