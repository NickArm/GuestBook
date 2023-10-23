<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_title',
        'email',
        'phone',
        'address',
        'country',
        'google_maps',
        'checkin',
        'checkout',
        'property_rules',
    ];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class);
    }

    public function guides()
    {
        return $this->hasMany(PropertyGuide::class);
    }

    public function localBusinesses()
    {
        return $this->belongsToMany(LocalBusiness::class);
    }

}
