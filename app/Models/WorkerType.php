<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerType extends Model
{
    protected $table = 'worker_types';

    public function users() {
        return $this->hasMany(User::class, 'worker_type_id', 'id');
    }
}
