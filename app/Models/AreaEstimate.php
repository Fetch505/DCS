<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaEstimate extends Model
{
    protected $table = 'area_estimate';

    public function project()
    {
      return $this->belongsTo(ProjectCostEstimate::class,'project_cost_estimates_id');
    }

    public function selectedElements()
    {
      return $this->hasMany(AreaEstimateSelectedElements::class,'area_estimate_id');
    }

    public function selectedTasks()
    {
      return $this->hasMany(AreaEstimateSelectedTasks::class,'area_estimate_id');
    }
}
