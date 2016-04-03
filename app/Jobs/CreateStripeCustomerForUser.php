<?php

namespace Animociel\Jobs;

use Animociel\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateStripeCustomerForUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $token;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token = null)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->user->createAsStripeCustomer($this->token, [
            'description' => "{$this->user->username} ({$this->user->profile->full_name})",
            'metadata' => [
                'user_id' => $this->user->id
            ]
        ]);
    }
}
