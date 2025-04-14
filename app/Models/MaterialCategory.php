<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    protected $fillable = [ 'company_id','name', 'consumable', 'has_usage_limit'];

    public function materialTypes()
    {
        return $this->hasMany(MaterialType::class);
    }
}

