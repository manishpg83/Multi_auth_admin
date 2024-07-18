<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $trackingId;

    public function __construct($details, $trackingId)
    {
        $this->details = $details;
        $this->trackingId = $trackingId;
    }

    public function build()
    {
        return $this->subject('Test Email')
                    ->view('emails.testEmail')
                    ->with([
                        'trackingPixel' => route('email.track', ['id' => $this->trackingId])
                    ]);
    }
}