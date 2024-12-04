<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppNotificationService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    /**
     * Send a WhatsApp message.
     *
     * @param  string  $to
     * @param  string  $message
     * @return void
     */
    public function sendWhatsAppMessage($to, $message)
    {
        $this->twilio->messages->create(
            'whatsapp:' . $to, // WhatsApp-enabled number
            [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' => $message,
            ]
        );
    }
}
