<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

      if (strpos($this->video_url, '.mp4') !== false || strpos($this->video_url, '.avi') !== false || strpos($this->video_url, '.mov') !== false || strpos($this->video_url, '.wmv') !== false){
        $type="video";
      }
      elseif (strpos($this->video_url, '.pdf') !== false){
        $type="pdf";
      }
      elseif (strpos($this->video_url, '.jpg') !== false || strpos($this->video_url, '.jpeg') !== false || strpos($this->video_url, '.png') !== false){
        $type="image";
      }
      else{
        $type="unsupported";
      }

      return [
        'id' => $this->id,
        'file_type' => $type,
        'category_id' => $this->category->id,
        'category' => $this->category->name,
        'title' => $this->title,
        'desc' => $this->description,
        'video_url' => $this->video_url,
      ];
    }
}
