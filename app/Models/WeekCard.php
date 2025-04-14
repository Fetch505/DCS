<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekCard extends Model
{
  public function day()
  {
      return $this->belongsTo(Day::class,'days_id');
  }

  public function timeCards()
  {
      return $this->hasMany(TimeCard::class,'week_cards_id');
  }
}
