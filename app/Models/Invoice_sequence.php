<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_sequence extends Model
{
    protected $fillable = [
        'period',
        'last_number',
    ];
    
}
