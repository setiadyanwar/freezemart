<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    // mass assignment
    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // relationship
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class);
    }



}
