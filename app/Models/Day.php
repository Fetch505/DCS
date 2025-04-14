<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{

    protected $table = 'days';

    protected $fillable = [
        'type','days','task_id','project_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function element()
    {
        return $this->belongsTo(Element::class,'element_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weekCards()
    {
        return $this->hasMany(WeekCard::class,'days_id');
    }

    public function project() {
      return $this->belongsTo(Project::class, 'project_id');
    }

    public function floorType()
    {
        return $this->belongsTo(FloorType::class,'floor_types_id');
    }
}
