<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectedSupervisorsTeamResource extends JsonResource
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
          'group_id' => $this->group_id,
          'group_name' => $this->group_name,
          'hourly_rate' => $this->hourly_rate,
          'percentage' => $this->percentage,
          'gross_wage' => $this->group->gross_hour_wage,
          ];
    }
}
