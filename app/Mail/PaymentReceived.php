<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PaymentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->view('emails.payment_received')
            ->subject('Ödemeniz Alındı');
    }
}
