<?php

namespace Animociel\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Animociel\Events\User\UserRegistered' => [
            'Animociel\Listeners\User\CreateStripeCustomer',
            'Animociel\Listeners\User\SendWelcomeEmail',
        ],
        'Animociel\Events\User\UserFilledProfile' => [
            'Animociel\Listeners\User\UpdateStripeCustomer',
        ],
        'Animociel\Events\User\UserUpdatedProfile' => [
            'Animociel\Listeners\User\UpdateStripeCustomer',
        ],
        'Animociel\Events\User\UserUpdatedAccount' => [
            'Animociel\Listeners\User\UpdateStripeCustomer',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
