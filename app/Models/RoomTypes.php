<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    public function floorTypes()
    {
      return $this->belongsToMany(FloorType::class);
    }
}
