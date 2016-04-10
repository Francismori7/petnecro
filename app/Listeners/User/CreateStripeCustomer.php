<?php

namespace Animociel\Listeners\User;

use Animociel\Events\User\UserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStripeCustomer implements ShouldQueue
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
     * @param UserEvent $event
     */
    public function handle(UserEvent $event)
    {
        $event->user->createAsStripeCustomer(null, [
            'description' => "{$event->user->username} (" . ($event->user->profile->full_name ?? 'Aucun profil') . ')',
            'metadata' => [
                'user_id' => $event->user->id,
            ],
        ]);
    }
}
