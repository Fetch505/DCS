<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloorType extends Model
{
  public function day()
  {
    return $this->hasOne(Day::class,'floor_types_id');
  }

  public function roomTypes()
  {
    return $this->belongsToMany(RoomTypes::class);
  }
}
