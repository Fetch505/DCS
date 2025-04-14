<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthAndSafety extends Model
{
    protected $table = 'health_and_safety';
    
    public function category() {
        return $this->belongsTo(HealthCategory::class, 'category_id');
      }
}
