<?php

namespace App\Http\Resources;
use App\Models\Leave;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $leave = Leave::where('id','=',$this->leave_id)->first();

        //$created_at = Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
        //$updated_at = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');
        return [
          'id' => $this->id,
          "user_id" => $this->user_id,
          "leave" => $leave,
          "leave_type" => $leave->leave_type,
          "reports_to_id" => $this->reports_to_id,
          "approved_by" => json_decode($this->approved_by),
          "created_at" => [
                "date" => $this->created_at->format('Y-m-d H:i:s'),
                "timezone" => $this->created_at->getTimezone()->getName(),
          ],
          "updated_at" => [
                "date" => $this->updated_at->format('Y-m-d H:i:s'),
                "timezone" => $this->updated_at->getTimezone()->getName(),
          ],
        ];
    }
}
