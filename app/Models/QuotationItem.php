<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    protected $fillable = ['quotation_id','worker_type_id', 'total_workers', 'rate', 'total_hours_per_worker', 'discount', 'net_rate', 'price'];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function workerType()
    {
        return $this->belongsTo(WorkerType::class);
    }
}