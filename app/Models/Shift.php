<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';
    
    public function users()
    {
        return $this->hasMany(User::class,'shift_id');
    }
}
