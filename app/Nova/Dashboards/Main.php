<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Employees;
use App\Nova\Metrics\Inquiries;
use App\Nova\Metrics\Students;
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
            Students::make(),
            Employees::make(),
            Inquiries::make(),
        ];
    }
}
