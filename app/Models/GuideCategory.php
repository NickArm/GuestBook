<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideCategory extends Model
{
    use HasFactory;
    public function guides()
{
    return $this->hasMany(PropertyGuide::class, 'category_id');
}

}
