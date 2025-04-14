<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialOrder extends Model
{
    protected $table = 'material_order';
    protected $fillable = [
        'company_id',
        'quantity',
    ];

    public function orderDetails()
    {
        return $this->hasMany(MaterialOrderDetail::class, 'order_id');
    }
}
