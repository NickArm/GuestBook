<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGuide extends Model
{
    protected $fillable = ['title', 'category_id', 'video_url', 'video_file', 'content', 'image'];

    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function category()
    {
        return $this->belongsTo(PropertyGuideCategory::class, 'category_id');
    }
}
