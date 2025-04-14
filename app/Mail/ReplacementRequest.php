<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplacementRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $emp_agency, $emp_name, $fromDate, $toDate, $type, $remarks,$project_name, $project_address;

    public function __construct($emp_agency, $emp_name, $from, $to, $type, $remarks,$project_name, $project_address)
    {
        $this->emp_agency       = $emp_agency;
        $this->emp_name         = $emp_name;
        $this->fromDate         = $from;
        $this->toDate           = $to;
        $this->type             = $type;
        $this->remarks          = $remarks;
        $this->project_name     = $project_name;
        $this->project_address  = $project_address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@acs.com')
                    ->subject("Replacement Request")
                    ->markdown('emails.replacement_request')->with([
                      'emp_name'        => $this->emp_name,
                      'emp_agency'      => $this->emp_agency,
                      'fromDate'        => $this->fromDate,
                      'toDate'          => $this->toDate,
                      'type'            => $this->type,
                      'remarks'         => $this->remarks,
                      'project_name'    => $this->project_name,
                      'project_address' => $this->project_address,
                  ]);
    }
}
