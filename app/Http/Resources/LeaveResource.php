<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
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
          'details' => $this->details,
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'status' => $this->status,
          'leave_type' => $this->leave_type,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
          'approved_by' => json_decode($this->users[0]->pivot->approved_by),
        ];
    }
}
