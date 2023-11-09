<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyService extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'property_id', 'description', 'image', 'definition'];

}
