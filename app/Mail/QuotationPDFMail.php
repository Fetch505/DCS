<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationPDFMail extends Mailable
{
    use Queueable, SerializesModels;
    public $quotationPDF;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotationPDF)
    {
        $this->quotationPDF = $quotationPDF;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = $this->quotationPDF->output();
        return $this->markdown('emails.quotation-pdf')
            ->subject('Quotation PDF')
            ->attachData($pdf, 'quotation.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
