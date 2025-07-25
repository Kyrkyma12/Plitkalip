<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}
