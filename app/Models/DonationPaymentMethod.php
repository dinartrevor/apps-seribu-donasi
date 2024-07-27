<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationPaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'donation_id',
        'payment_method_id',
        'account_number',
        'account_holder_name',
    ];


    /**
     * Get the user that owns the DonationPaymentMethod
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    
}
