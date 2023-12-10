<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyService extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'property_id', 'description', 'image', 'form_definition'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
