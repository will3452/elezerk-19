<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Models\Log;

class AnnouncementObserver
{
    public function created(Announcement $a) {
        Log::userCreate([
            'type' => 'announcement',
            'description' => "'$a->title' has been posted to announcement.",
        ]);
    }

    public function deleting(Announcement $a) {
        Log::userCreate([
            'type' => 'announcement',
            'description' => "'$a->title' has been deleted.",
        ]);
    }
}
