<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Announcement;
use Laravel\Nova\Notifications\NovaNotification;

class AnnouncementObserver
{
    public function created(Announcement $announcement) {
        $users = User::get();

        foreach ($users as $user) {
            $user->notify( NovaNotification::make()
                ->message('New announcement has been created!')
                ->action('View announcement', '/resources/announcements/' . $announcement->id)
                ->icon('speakerphone'),
            );
        }
    }
}
