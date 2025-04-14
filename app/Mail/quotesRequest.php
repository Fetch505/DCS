<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class quotesRequest extends Mailable
{
    use Queueable, SerializesModels;
    protected $supp_name, $supp_email,$product_name, $quantity, $buyer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supp_name,$supp_email,$product_name,$quantity,$buyer)
    {
        $this->supp_name = $supp_name;
        $this->supp_email = $supp_email;
        $this->product_name = $product_name;
        $this->quantity = $quantity;
        $this->buyer = $buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $this->replyTo($this->buyer);
       return $this->subject('ACS - Request For Quotes')
        ->markdown('Company_Admin.quotes.quotesRequestMail')
        ->with([
            'supp_name' => $this->supp_name,
            'supp_email' => $this->supp_email,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'from' => $this->buyer,
        ]);
    }
}
