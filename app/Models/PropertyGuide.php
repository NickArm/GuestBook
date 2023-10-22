<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGuide extends Model
{
    use HasFactory;
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function category()
    {
     return $this->belongsTo(GuideCategory::class, 'category_id');
    }

}
