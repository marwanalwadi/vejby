<?php

namespace App\Models;

use App\Models\Details;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function details()
    {
        return $this->hasMany(Details::class);
    }
}
