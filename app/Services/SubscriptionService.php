<?php

namespace App\Services;

use App\Models\Subscription;

class SubscriptionService
{
    public function save(array $data)
    {
        $subscription = new Subscription();
        $subscription->user_id = $data["user_id"];
        $subscription->renewal_at = $data['renewal_at'];
        $subscription->save();

        return $subscription;
    }
    public function update(Subscription $subscription,array $data)
    {
        $subscription->renewal_at = $data['renewal_at'];
        $subscription->save();

        return $subscription;
    }

    public function getAll()
    {
        $subscriptions = Subscription::all();

        return $subscriptions;
    }
}
