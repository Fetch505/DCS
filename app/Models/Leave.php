<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';

    public function leave_type()
    {
      return $this->belongsTo(LeaveType::class);
    }

    public function status()
    {
      return $this->belongsTo(Status::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class)
                  ->withPivot([
                            'approved_by',
                        ]);
    }
}
