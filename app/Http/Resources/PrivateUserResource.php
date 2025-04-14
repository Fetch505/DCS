<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
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
         'profile' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role->name,
                'company_allow_sick_leaves' => $this->company_id ? $this->companyAllowedSickLeaves($this->company_id) : false, // function written inside User model
                'permissions' => $this->permissions->pluck('name')
             ],
         ];
     }
}
