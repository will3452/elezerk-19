<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Bid;
use App\Models\Document;
use App\Models\Event as ModelsEvent;
use App\Observers\AnnouncementObserver;
use App\Observers\BidObserver;
use App\Observers\DocumentObserver;
use App\Observers\EventObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Document::observe(DocumentObserver::class);
        Announcement::observe(AnnouncementObserver::class);
        ModelsEvent::observe(EventObserver::class);
        Bid::observe(BidObserver::class);
    }
}
