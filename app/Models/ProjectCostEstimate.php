<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCostEstimate extends Model
{
    public function areaestimates()
    {
      return $this->hasMany(AreaEstimate::class,'project_cost_estimates_id');
    }

    public function supTeam()
    {
      return $this->hasMany(ProjectCostSupervisionTeam::class,'project_cost_estimates_id');
    }

    public function prodTeam()
    {
      return $this->hasMany(ProjectCostProductionTeam::class,'project_cost_estimates_id');
    }
}
