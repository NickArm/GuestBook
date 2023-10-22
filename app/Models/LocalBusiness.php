<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalBusiness extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'title', 'description', 'image', 'google_map', 'directions_url', 'external_url'];
    
    public function category()
    {
        return $this->belongsTo(LocalBusinessCategory::class, 'category_id');
    }
    
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
