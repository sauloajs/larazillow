<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Filter offers according to current authenticated user
     *
     * @param Builder $query The query to be modified
     *
     * @return Builder
     */
    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }

    /**
     * Filter offers removing a specific offer
     *
     * @param Builder $query The query to be modified
     * @param Offer   $offer The offer to be excluded from query
     *
     * @return Builder
     */
    public function scopeExcept(Builder $query, Offer $offer): Builder
    {
        return $query->where('id', '!=', $offer->id);
    }
}
