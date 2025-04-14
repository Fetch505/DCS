<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Element extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'elements'
    ];

    public function days()
    {
      return $this->hasMany(Day::class,'element_id');
    }

    public function selectionInfo()
    {
      return $this->hasOne(AreaEstimateSelectedElements::class,'element_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
