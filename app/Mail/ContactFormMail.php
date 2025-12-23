<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $isAutoReply;

    public function __construct($data, $isAutoReply = false)
    {
        $this->data = $data;
        $this->isAutoReply = $isAutoReply;
    }

    public function build()
    {
        if ($this->isAutoReply) {
            return $this->subject('Thank you for contacting WabeGadgets')
                       ->view('emails.contact.auto-reply');
        }

        return $this->subject('New Contact Form Submission')
                   ->view('emails.contact.admin-notification');
    }
} 