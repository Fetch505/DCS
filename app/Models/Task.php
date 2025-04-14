<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  
  public function element()
  {
    return $this->belongsTo(Element::class);
  }

  public function materials()
  {
    return $this->belongsToMany(Material::class, 'tasks_materials');
  }

  public function days()
  {
    return $this->hasMany(Day::class);
  }

  public function selectionInfo()
  {
      return $this->hasOne(AreaEstimateSelectedTasks::class,'task_id');
  }
}
