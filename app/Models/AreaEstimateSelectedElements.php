<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaEstimateSelectedElements extends Model
{
  public function projectCostEstimate()
  {
    return $this->belongsTo(ProjectCostEstimate::class,'area_estimate_id');
  }

  public function elementInfo()
  {
    return $this->belongsTo(Element::class,'element_id');
  }
}
