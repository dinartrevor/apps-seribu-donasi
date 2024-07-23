<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Donor extends Model
{
    use HasFactory;
    protected $fillable = [
        'donation_id',
        'payment_method_id',
        'user_id',
        'title',
        'status',
        'amount',
        'image',
        'notes',
    ];

    /**
     * Get the user that owns the Donor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
    /**
     * Get the user that owns the Donor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
