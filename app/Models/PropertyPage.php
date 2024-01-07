<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPage extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'title', 'content'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
