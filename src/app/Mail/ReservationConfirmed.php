<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $qrCodeUrl;

    public function __construct($user, $qrCodeUrl)
    {
        $this->user = $user;
        $this->qrCodeUrl = $qrCodeUrl;
    }

    public function build()
    {
        return $this->subject('予約が確定しました')
                    ->view('emails.confirm-reservation');
    }
}
