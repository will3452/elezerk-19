<?php

namespace App\Observers;

use App\Models\Bid;
use App\Models\Log;

class BidObserver
{
    public function created(Bid $a) {
        Log::userCreate([
            'type' => 'bid',
            'description' => "'$a->topic' has been created.",
        ]);
    }

    public function deleting(Bid $a) {
        Log::userCreate([
            'type' => 'bid',
            'description' => "'$a->topic' has been deleted.",
        ]);
    }
}
