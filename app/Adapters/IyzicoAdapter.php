<?php

namespace App\Adapters;

class IyzicoAdapter
{
    public function pay($amount)
    {
        \Log::info('Iyzico payment successful');
        return true;
    }
}
