<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MethodResource extends JsonResource
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
        'category_id' => $this->category->id,
        'category' => $this->category->name,
        'title' => $this->title,
        'desc' => $this->description,
        'video_url' => $this->video_url,
      ];
    }
}
