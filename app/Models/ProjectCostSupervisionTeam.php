<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCostSupervisionTeam extends Model
{
  public function projectCost()
  {
    return $this->belongsTo(ProjectCostEstimate::class,'project_cost_estimates_id');
  }

  public function group()
  {
      return $this->belongsTo(EmployeeGroup::class,'group_id');
  }
}
