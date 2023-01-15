<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\Trainee;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;

class TaskObserver
{
    public function created(Task $task) {
        $sy = $task->school_year;
        $section = $task->section;

        $trainees = Trainee::whereSchoolYear($sy)
            ->whereSection($section)
            ->get();

        foreach ($trainees as $trainee) {
            $trainee->user->notify(NovaNotification::make()
                ->message('New task has been created!')
                ->icon('bolt')
            );
        }
    }
}
