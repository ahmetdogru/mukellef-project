<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends ApiController
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }
    public function saveSubscription(SubscriptionRequest $request, $userId)
    {
        $user = User::find($userId);
        if (!$user)
        {
            return $this->sonucGetir(false,"User not found", null, 404);
        }

        $subscriptionData = $request->only(['renewal_at']);
        $subscriptionData["user_id"] = $userId;
        $subscription = $this->subscriptionService->save($subscriptionData);
        return $this->sonucGetir(true,"İşlem başarılı", $subscription, 201);
    }
    public function updateSubscription(Request $request, $userId, $subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);
        if (!$subscription)
        {
            return $this->sonucGetir(false,"Subscription not found", null, 404);
        }

        $subscriptionData = $request->only(['renewal_at']);

        $subscription = $this->subscriptionService->update($subscription, $subscriptionData);

        return $this->sonucGetir(true,"Successful", $subscription, 201);
    }

    public function listSubscription()
    {
        $list = $this->subscriptionService->getAll();
        return $this->sonucGetir(true,"Successful", $list, 201);

    }
    public function deleteSubscription($userId, $subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);
        if (!$subscription)
            return $this->sonucGetir(false,"Subscription not found", null, 404);

        $subscription->delete();

        return $this->sonucGetir(true,"Successful", null, 201);
    }
}
