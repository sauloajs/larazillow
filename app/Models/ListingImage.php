<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename'
    ];

    protected $appends = [
        'src'
    ];

    /**
     * All listing images must have a listing
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the asset for the image link
     *
     * @return string
     */
    public function getSrcAttribute(): string
    {
        return asset("storage/$this->filename");
    }
}
