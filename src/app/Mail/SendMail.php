<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;
    public $attachment;

    public function __construct($subject, $messageContent, $attachment = null)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
        $this->attachment = $attachment;
    }

    public function build()
    {
        $email = $this->view('emails.admin-email')
            ->with(['messageContent' => $this->messageContent])
            ->subject($this->subject);

        if ($this->attachment && $this->attachment->isValid()) {
        $email->attach($this->attachment->getRealPath(), [
            'as' => $this->attachment->getClientOriginalName(),
            'mime' => $this->attachment->getMimeType(),
        ]);
    }

        return $email;
    }
}
