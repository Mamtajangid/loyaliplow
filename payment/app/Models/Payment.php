<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    protected $table="payments";
    protected $fillable = [
        'razorpay_payment_id',
        'amount',
        'email',
        'number',
        'status'
    
    ];
}

