<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalBusinessCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function localBusinesses()
    {
        return $this->hasMany(LocalBusiness::class, 'category_id');
    }
}
