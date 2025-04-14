<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeGroup extends Model
{
    protected $table = 'employee_groups';

    public function teamProd()
    {
        return $this->hasOne(ProjectCostProductionTeam::class,'group_id');
    }

    public function teamSuperv()
    {
        return $this->hasOne(ProjectCostSupervisionTeam::class,'group_id');
    }
}
