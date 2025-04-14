<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'customers';

  public function company(){
    return $this->belongsTo(User::class, 'company_id');
  }


  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }


  public function projects(){
    return $this->hasMany(Project::class);
  }
}
