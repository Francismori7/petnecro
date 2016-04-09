<?php

namespace Animociel\Listeners\User;

use Animociel\Events\User\UserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserEvent $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        //
    }
}
