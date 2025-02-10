<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'report_id',
        'name',
        'currency',
        'amount',
        'discount',
        'final_amount',
        'commercial_register',
        'tax_card',
        'zakat_card',
        'shop_license',
        'notes',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}