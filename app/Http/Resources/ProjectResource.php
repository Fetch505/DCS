<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'description' => $this->description,
          'manager_id' => $this->projectSupervisor->reports_to_id,
          'supervisor_id' => $this->supervisor_id,
          'supervisor_name' => $this->projectSupervisor->name,
          'customer_id' => $this->customer_id,
          'customer' => $this->customer,
          'phone' => $this->phone,
          'address' => $this->address,
          'city' => $this->city,
          'houseNumber' => $this->houseNumber,
          'zipcode' => $this->zipcode,
          'postcode' => $this->postcode,
          'country' => $this->country,
          'fax' => $this->fax,
          'notes' => $this->notes,
          'weekcard' => $this->weekcard,
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'break' => $this->break,
          'code' => $this->code,
          'supervisor_id' => $this->supervisor_id,
          'inspector_id' => $this->inspector_id,
          'jobs' => JobResource::collection($this->jobs),
          'locations' => LocationResource::collection($this->locations),
        ];
    }
}
