<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;
    public function faqs()
    {
    return $this->hasMany(FAQ::class, 'category_id');
    }

}
