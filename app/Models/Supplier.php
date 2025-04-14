<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  public function materials() {
    return $this->belongsToMany(Material::class, 'suppliers_materials');
  }
}
