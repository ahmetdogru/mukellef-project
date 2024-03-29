<?php

namespace App\Providers;

use App\Adapters\IyzicoAdapter;
use App\Adapters\StripeAdapter;
use App\Mail\PaymentReceived;

class PaymentProvider
{
    private $adapter;
    private $paymentProvider;
    private $userEmail;

    public function __construct($paymentProvider, $userEmail)
    {
        $this->paymentProvider = $paymentProvider;
        $this->userEmail = $userEmail;

        if ($this->paymentProvider === 'stripe')
            $this->adapter = new StripeAdapter();
        elseif ($this->paymentProvider === 'iyzico')
            $this->adapter = new IyzicoAdapter();
        else
            throw new \InvalidArgumentException('Invalid payment provider');
    }

    // Ödeme yapma metodu
    public function pay($amount)
    {
        $resp = $this->adapter->pay($amount);
        if($resp)
        {
            \Log::info('Email sent');
//            Mail::to($this->userEmail)->send(new PaymentReceived());
        }
        return $resp;
    }
}
