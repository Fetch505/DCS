<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialProjectTransaction extends Model
{
    protected $guarded = [];

    protected $table = 'material_project_transactions';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'payment_proof',
        'total_quantity',
        'created_at'
    ];
}
