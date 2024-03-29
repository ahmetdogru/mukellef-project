<?php

use App\Models\Subscription;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function ()
{
    \Log::info('Schedule run');
    $subscriptions = Subscription::all();
    $currentDate = Carbon::now()->format('Y-m-d');

    foreach ($subscriptions as $subscription)
    {
        if ($subscription->renewal_at <= $currentDate)
        {
            $subscription->renewal_at = Carbon::now()->addMonth()->format('Y-m-d');
            $subscription->save();
        }
    }
})->everyMinute();
