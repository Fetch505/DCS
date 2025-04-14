<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionReview extends Model
{
    protected $table = 'inspections_review';

    public function project()
    {
      return $this->belongsTo(Project::class);
    }

    public function inspector()
    {
      return $this->belongsTo(User::class,'inspector_id');
    }

    public function timecards()
    {
      return $this->hasMany(TimeCard::class);
    }
}
