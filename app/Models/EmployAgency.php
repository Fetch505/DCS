<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployAgency extends Model
{
  public function users() {
    return $this->hasMany(User::class);
  }

  public function company() {
    return $this->belongsTo(User::class, 'company_id');
  }

}
