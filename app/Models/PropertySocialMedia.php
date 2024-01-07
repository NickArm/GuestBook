<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySocialMedia extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'social_media_name', 'profile_url'];

    /**
     * Get the property that owns the social media.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
