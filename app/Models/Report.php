<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_number',
        'project',
        'item',
        'committees_members',
        'committees_chairman',
    ];

    protected $casts = [
        'committees_members' => 'array', // Store as JSON
    ];

    public function bidders()
    {
        return $this->hasMany(Bidder::class);
    }
}