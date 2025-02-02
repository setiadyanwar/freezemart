<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkout extends Model
{
    // mass assignment
    protected $guarded = ['id'];


    // relationship
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}
