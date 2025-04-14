<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
          'floor_id' => $this->floor->id,
          'floor_name' => $this->floor->name,
          'days' => DayResource::collection($this->days),
        ];
    }
}
