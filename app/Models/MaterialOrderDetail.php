<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialOrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'material_id',
        'quantity',
        'project',
        'supplier_id',
    ];
    public function order()
    {
        return $this->belongsTo(MaterialOrder::class, 'order_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
