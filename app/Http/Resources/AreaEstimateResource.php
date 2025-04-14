<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaEstimateResource extends JsonResource
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
          'floor_type' => $this->floor_type,
          'room_type' => $this->room_type,
          'frequency' => $this->frequency,
          'factor' => $this->factor,
          'sq_meter_area_per_hour' => $this->sq_meter_area_per_hour,
          'project_cost_estimates_id' => $this->project_cost_estimates_id,
          'floor_type_id' => $this->floor_type_id,
          'room_type_id' => $this->room_type_id,
          'comment' => $this->comment,
          'tasks' => SelectedTasksResource::collection($this->selectedTasks),
          'elements' => SelectedElementsResource::collection($this->selectedElements),
        ];

    }
}
