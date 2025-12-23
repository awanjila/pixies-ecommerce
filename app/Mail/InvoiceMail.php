<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $contents;

    public function __construct($data, $contents)
    {
        $this->data = $data;
        $this->contents = $contents;
    }

    public function build()
    {
        $pdf = PDF::loadView('emails.invoiceMail', [
            'data' => $this->data,
            'contents' => $this->contents
        ]);

        return $this->subject('Quotation Details')
                    ->view('emails.plain') // Optional: if you want to send a plain text along with PDF
                    ->attachData($pdf->output(), 'quotation.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}