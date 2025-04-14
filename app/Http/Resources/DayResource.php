<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DayResource extends JsonResource
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
          'frequency' => $this->frequency,
          'status' => $this->status,
          'factor' => $this->factor,
          'hours' => $this->hours,
          'minutes' => $this->minutes,
          'mon' => $this->mon,
          'tue' => $this->tue,
          'wed' => $this->wed,
          'thu' => $this->thu,
          'fri' => $this->fri,
          'sat' => $this->sat,
          'sun' => $this->sun,
          'type' => $this->type,
          'project_id' => $this->project->id,
          'project_name' => $this->project->name,
          'customer' => $this->project->customer,
          'element_id' => $this->element['id'],
          'element_name' => $this->element['name'],
          'element_name_eng' => $this->element['name_eng'],
          // 'floor_type_id' => $this->floorType->id,
          // 'floor_type_name' => $this->floorType->name,
          'task_id' => $this->task['id'],
          'task_name' => $this->task['name'],
          'task_name_eng' => $this->task['name_eng'],
          'worker_id' => $this->user['id'],
          'worker' => $this->user['name'],
          'employee_code' => $this->user['employee_code'],
          'area_id' => $this->area['id'],
          'location_id' => $this->location_id,
          'location' => $this->location['name'],
          'week_number' => json_decode($this->week_number),
          'area_name' => $this->area['name'],
          'area' => new AreaResource($this->area),
          // 'area_name' => $this->areas->name,
        ];
    }
}
