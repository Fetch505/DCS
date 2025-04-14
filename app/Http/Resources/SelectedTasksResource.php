<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectedTasksResource extends JsonResource
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
          'id' => $this->taskInfo->id,
          'task_name' => $this->taskInfo->name,
          'task_frequency' => $this->frequency,
          'sel_task_table_id' => $this->id,
        ];
    }
}
