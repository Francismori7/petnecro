<?php

namespace Animociel\Jobs;

use Animociel\Jobs\Job;
use Animociel\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStripeCustomerForUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $customer = $this->user->asStripeCustomer();
        $customer->email = $this->user->email;
        $customer->description = "{$this->user->username} ({$this->user->profile->full_name})";
        $customer->save();
    }
}
