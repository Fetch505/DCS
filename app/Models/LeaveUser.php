<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveUser extends Model
{
    protected $table = 'leave_user';
    protected $fillable = ['approved_by'];
    // protected $casts = ['approved_by' => 'array'];
}
