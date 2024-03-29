<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RefreshSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renews subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('Command run');
        $subscriptions = Subscription::all();
        $currentDate = Carbon::now()->format('Y-m-d');

        foreach ($subscriptions as $subscription)
        {
            $this->info($subscription->renewal_at);
            if ($subscription->renewal_at <= $currentDate)
            {
                $subscription->renewal_at = Carbon::now()->addMonth()->format('Y-m-d');
                $subscription->save();
                $this->info('Subscription renewed ' . $subscription->id);
            }
        }

        $this->info('Subscriptions renewed');
    }
}
