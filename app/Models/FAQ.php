<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faqs';
    protected $fillable = ['question', 'answer', 'category_id', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }

}
