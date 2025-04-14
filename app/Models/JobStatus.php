<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $table = 'job_status';

    public function user()
    {
        return $this->belongsTo(TimeCard::class);
    }
}
