<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementRequest extends Model
{
    protected $fillabel = ['supervisor_id', 'user_id', 'type', 'from', 'to', 'count', 'status', 'remarks', 'project_id'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function project() {
      return $this->belongsTo(Project::class);
    }
}
