<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

  public function project()
  {
    return $this->belongsTo(Project::class);
  }

   public function job()
    {
        return $this->hasOne(Project::class,'location_id');
    }

}
