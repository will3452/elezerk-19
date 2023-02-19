<?php

namespace App\Nova\Dashboards;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use Elezerk\Bac\Bac;
use App\Models\Visit;
use App\Nova\Metrics\Bids;
use App\Nova\Metrics\Users;
use App\Nova\Metrics\Events;
use Laravel\Nova\Cards\Help;
use Elezerk\Calendar\Calendar;
use App\Nova\Metrics\Documents;
use App\Nova\Metrics\Announcements;
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
            Bac::make()->withMeta([
                'bids' => \App\Models\Bid::with('participants.user')->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)->whereStatus('Done')->latest()->get(),
                'events' => \App\Models\Event::get(),
                'users' => \App\Models\User::get(),
                'announcements' => \App\Models\Announcement::get(),
                'visit_today' => Visit::whereDate('created_at', \Carbon\Carbon::today())->get(),
                'visit_week' => Visit::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->get(),
                'visit_all' => Visit::get(),
                'logs' => Log::whereUserId(auth()->id())->latest()->get(),
                ])
            // Users::make()->canSee(fn () => auth()->user()->type == User::TYPE_ADMIN),
            // Announcements::make(),
            // Events::make(),
            // Documents::make()->canSee(fn () => auth()->user()->type == User::TYPE_ADMIN),
            // Bids::make(),
        ];
    }
}
