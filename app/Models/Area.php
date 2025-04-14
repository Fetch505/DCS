<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

  public function days()
  {
    return $this->hasMany(Day::class);
  }
}
