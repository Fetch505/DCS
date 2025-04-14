<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  protected $fillable = [
    'company_id',
    'material_type_id',
    'name', 
    'quantity', 
  ];
  
  public function suppliers() {
    return $this->belongsToMany(Supplier::class, 'suppliers_materials');
  }

  public function tasks() {
    return $this->belongsToMany(Task::class, 'tasks_materials');
  }

  public function projects()
  {
    return $this->belongsToMany(Project::class, 'material_project', 'material_id', 'project_id')
          ->withPivot('quantity', 'consumption_per_day')
          ->withTimestamps();
  }

  public function assignedUsers()
  {
    return $this->belongsToMany(User::class, 'material_assignments', 'material_id', 'user_id')
        ->withPivot('project_id', 'quantity', 'usage_limit')
        ->withTimestamps();
  }

  public function materialType()
  {
      return $this->belongsTo(MaterialType::class);
  }
}
