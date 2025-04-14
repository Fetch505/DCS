<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaEstimateSelectedTasks extends Model
{
  public function projectCostEstimate()
  {
    return $this->belongsTo(ProjectCostEstimate::class,'area_estimate_id');
  }

  public function taskInfo()
  {
    return $this->belongsTo(Task::class,'task_id');
  }

}
