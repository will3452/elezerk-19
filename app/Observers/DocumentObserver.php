<?php

namespace App\Observers;

use App\Models\Document;
use App\Models\Log;

class DocumentObserver
{
    public function created(Document $d) {
        Log::userCreate([
            'type' => 'document',
            'description' => "'$d->title' has been added to documents",
        ]);
    }
}
