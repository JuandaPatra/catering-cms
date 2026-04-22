<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_phone',
        'invoice_date',
        'subtotal',
        'discount',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(Invoice_items::class);
    }
}
