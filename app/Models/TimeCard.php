<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeCard extends Model
{
  protected $table = 'time_cards';

  public function inspectionReview()
  {
      return $this->belongsTo(InspectionReview::class);
  }

  public function weekCard()
  {
      return $this->belongsTo(WeekCard::class,'week_cards_id');
  }

  public function jobStatus()
  {
      return $this->hasOne(JobStatus::class);
  }
}
