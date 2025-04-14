<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Methods extends Model
{
    protected $table = 'methods';    

    public function category() {
        return $this->belongsTo(MethodCategory::class, 'category_id');
      }
  
}

