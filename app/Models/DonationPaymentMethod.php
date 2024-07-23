<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationPaymentMethod extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'donation_id',
        'payment_method_id',
        'account_number',
        'account_holder_name',
    ];
}
