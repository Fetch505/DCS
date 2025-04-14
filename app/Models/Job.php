<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'project_jobs';
    protected $fillable = ['floor_id'];

    // public function area()
    // {
    //     return $this->belongsTo(Area::class);
    // }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function days()
    {
        return $this->hasMany(Day::class);
    }

}
