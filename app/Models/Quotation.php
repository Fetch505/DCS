<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['company_name', 'poc', 'address', 'phone_number', 'rate_type', 'total_price'];

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }
}