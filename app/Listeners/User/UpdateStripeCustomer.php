<?php

namespace Animociel\Listeners\User;

use Animociel\Events\User\UserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStripeCustomer implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserEvent $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $customer = $event->user->asStripeCustomer();
        $customer->email = $event->user->email;
        $customer->description = "{$event->user->username} (" . $event->user->profile->full_name ?? 'Aucun profil' . ')';
        $customer->save();
    }
}
