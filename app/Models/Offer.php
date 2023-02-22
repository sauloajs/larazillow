<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'accepted_at',
        'rejected_at'
    ];

    /**
     * Relation with the listing model, each over must have a listing
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(
            Listing::class,
            'listing_id'
        );
    }

    /**
     * Relation with user model, each offer must have a bidder (user)
     *
     * @return BelongsTo
     */
    public function bidder(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'bidder_id'
        );
    }
}
