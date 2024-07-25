<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Donation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'image',
        'notes',
        'deleted_at',
    ];

    /**
     * Get all of the comments for the Donation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donationPaymentMethod(): HasMany
    {
        return $this->hasMany(DonationPaymentMethod::class);
    }

    /**
     * Get all of the comments for the Donation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donor(): HasMany
    {
        return $this->hasMany(Donor::class);
    }

    /**
     * Get the user that owns the Donation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
