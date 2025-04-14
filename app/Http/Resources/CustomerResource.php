<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'name' => $this->name,
        'mailbox' => $this->mailbox,
        'mailbox_city' => $this->mailbox_city,
        'mailbox_zip' => $this->mailbox_zip,
        'notes' => $this->notes,
      ];
    }
}
