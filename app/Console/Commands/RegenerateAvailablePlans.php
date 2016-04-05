<?php

namespace Animociel\Console\Commands;

use Animociel\AvailableSubscription;
use Illuminate\Console\Command;

class RegenerateAvailablePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerates the plans list.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plans = \Stripe\Plan::all()->__toArray(true)['data'];

        AvailableSubscription::truncate();
        $this->info('Deleted all plans.');

        $bar = $this->output->createProgressBar(count($plans));

        foreach ($plans as $plan) {
            $plan['identifier'] = $plan['id'];
            $plan = AvailableSubscription::create($plan);

            $this->line('');
            $this->line("Added plan ID '{$plan->identifier}' -> {$plan->name}");

            $bar->advance();
        }

        $bar->finish();

        $this->line('');

        $this->info('Deleted all plans and regenerated ' . count($plans) . ' plans.');
    }
}
