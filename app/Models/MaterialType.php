<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $fillable = ['company_id','material_category_id', 'name'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function materialCategory()
    {
        return $this->belongsTo(MaterialCategory::class);
    }
}