<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectElement extends Model
{

    protected $table = 'project_elements';

    protected $fillable = [
        'project_id','element_id','task_id'
    ];

    public function element()
    {
        return $this->belongsTo(Element::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
