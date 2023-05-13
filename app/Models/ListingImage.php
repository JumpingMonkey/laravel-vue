<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Summary of ListingImage
 */
class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'listing_id'];
    protected $appends = ['src'];

    /**
     * Summary of listing
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id', 'images');
    }

    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
