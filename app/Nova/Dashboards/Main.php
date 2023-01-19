<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\ActiveTrainee;
use App\Nova\Metrics\ArchiveStudents;
use App\Nova\Metrics\TotalTasks;
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
            TotalTasks::make(),
            ActiveTrainee::make(),
            ArchiveStudents::make(),
        ];
    }
}
