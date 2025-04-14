<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupplierNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $materials;
    public $supplierName;

    /**
     * Create a new message instance.
     *
     * @param array $materials
     * @param string $supplierName
     * @return void
     */
    public function __construct($materials, $supplierName)
    {
        $this->materials = $materials;
        $this->supplierName = $supplierName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Material Order")
                    ->markdown('emails.supplier_notification')
                    ->with([
                        'materials' => $this->materials,
                        'supplierName' => $this->supplierName
                    ]);
    }
}
