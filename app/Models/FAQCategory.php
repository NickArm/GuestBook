<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    protected $table = 'faq_categories';
    use HasFactory;
    protected $fillable = ['name', 'property_id'];

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'category_id');
    }
    public function property() {
        return $this->belongsTo(Property::class);
    }

}
