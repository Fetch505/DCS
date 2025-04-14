<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectedElementsResource extends JsonResource
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
              'id' => $this->elementInfo->id,
              'element_name' => $this->elementInfo->name,
              'element_frequency' => $this->frequency,
              'sel_element_table_id' => $this->id,
            ];
    }
}
