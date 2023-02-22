<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds',
        'bathrooms',
        'area',
        'city',
        'postal_code',
        'street',
        'street_number',
        'price',
    ];

    /**
     * The listing must have an owner
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The listing can have many images
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    /**
     * The listing can have many offers
     *
     * @return HasMany
     */
    public function offers(): HasMany
    {
        return $this->hasMany(
            Offer::class,
            'listing_id'
        );
    }

    /**
     * Get the listings by the newest
     *
     * @param Builder $query The listings query to be ordered
     *
     * @return Builder
     */
    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->latest();
    }

    /**
     * Get the listings and apply filters
     *
     * @param Builder $query   The listings query to be filtered
     * @param array   $filters The filters to be applied
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['priceFrom'] ?? null,
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? null,
            fn ($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? null,
            fn ($query, $value) => $query->where(
                'beds',
                (int)$value < 6 ? '=' : '>=',
                $value
            )
        )->when(
            $filters['bathrooms'] ?? null,
            fn ($query, $value) => $query->where(
                'bathrooms',
                (int)$value < 6 ? '=' : '>=',
                $value
            )
        )->when(
            $filters['areaFrom'] ?? null,
            fn ($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? null,
            fn ($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['deleted'] ?? false,
            fn ($query, $value) => $query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) => $query->orderBy(
                $value,
                $filters['order'] ?? 'desc'
            )
        );
    }
}
