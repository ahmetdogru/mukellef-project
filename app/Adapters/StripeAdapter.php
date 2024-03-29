<?php

namespace App\Adapters;

class StripeAdapter
{
    public function pay($amount)
    {
        \Log::info('Stripe payment successful');
        return true;
    }
}
