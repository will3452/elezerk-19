<?php

namespace App\Nova\Dashboards;

use App\Models\Event;
use Laravel\Nova\Dashboard;
use Elezerk\Calendar\Calendar as CalendarCard;

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
            CalendarCard::make()->width('full')->withMeta(['events' => Event::get()]),
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
