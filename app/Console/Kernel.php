<?php

namespace Animociel\Console;

use Animociel\AvailableSubscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $plans = \Stripe\Plan::all()->__toArray(true)['data'];

            AvailableSubscription::truncate();

            $count = 0;

            foreach($plans as $plan) {
                $plan['identifier'] = $plan['id'];
                AvailableSubscription::create($plan);
                $count++;
            }

            \Log::info("Removed and regenerated $count plans.");
        })->everyThirtyMinutes();
    }
}
