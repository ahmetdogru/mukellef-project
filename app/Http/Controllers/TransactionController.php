<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Providers\PaymentProvider;
use App\Providers\PaymentServiceProvider;

class TransactionController extends ApiController
{
    public function saveTransaction(TransactionRequest $request,$userId)
    {
        $user = User::find($userId);
        if (!$user)
        {
            return $this->sonucGetir(false,"User not found", null, 404);
        }
        $subscription = Subscription::find($request['subscription_id']);
        if (!$subscription)
        {
            return $this->sonucGetir(false,"Subscription not found", null, 404);
        }
        if($user->id != $subscription->user_id)
        {
            return $this->sonucGetir(false,"This subscription for the user was not found", null, 404);
        }

        $paymentProvider = new PaymentProvider($user->payment_provider, $user->email);
        if($paymentProvider->pay($request->input("price")))
        {

            $transactionData = $request->only(['subscription_id', 'price']);
            $transactionData["user_id"] = $userId;

            $transaction = new Transaction();
            $transaction->user_id = $transactionData["user_id"];
            $transaction->subscription_id = $transactionData["subscription_id"];
            $transaction->price = $transactionData["price"];
            $transaction->save();
            return $this->sonucGetir(true,"İşlem başarılı", $transaction, 201);
        }
        else
            return $this->sonucGetir(false,"payment failed", null, 422);
    }
    public function listTransaction()
    {
        return $this->sonucGetir(true,"İşlem başarılı", Transaction::all(), 201);
    }
}
