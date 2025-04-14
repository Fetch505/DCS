<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $table = 'projects';

  public function inspectionReports()
  {
    return $this->hasMany(InspectionReview::class);
  }

  public function externalReports()
  {
    return $this->hasMany(ExternalReport::class);
  }

  public function locations()
  {
    return $this->hasMany(Location::class);
  }

  public function jobs()
  {
    return $this->hasMany(Job::class);
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function materials()
    {
      return $this->belongsToMany(Material::class, 'material_project', 'project_id', 'material_id')
            ->withPivot('quantity', 'consumption_per_day')
            ->withTimestamps();
    }

    public function projectSupervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id');
    }

    public function projectInspector()
    {
        return $this->belongsTo(User::class,'inspector_id');
    }

    public function company() {
      return $this->belongsTo(User::class, 'company_id');
    }

    public function days()
    {
      return $this->hasMany(Day::class, 'project_id');
    }

}
