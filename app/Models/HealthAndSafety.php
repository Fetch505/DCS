<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthAndSafety extends Model
{
    protected $table = 'health_and_safety';
    // Protect fields against mass assignment
    protected $fillable = ['title', 'description', 'category_id', 'status', 'video_url'];

    public function category() {
        return $this->belongsTo(HealthCategory::class, 'category_id');
      }
}
