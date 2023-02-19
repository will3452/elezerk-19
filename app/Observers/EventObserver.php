<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Event;

class EventObserver
{
    public function created(Event $a) {
        Log::userCreate([
            'type' => 'event',
            'description' => "'$a->name' has been added.",
        ]);
    }

    public function deleting(Event $a) {
        Log::userCreate([
            'type' => 'event',
            'description' => "'$a->name' has been deleted.",
        ]);
    }
}
