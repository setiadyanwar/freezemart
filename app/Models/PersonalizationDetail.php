<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalizationDetail extends Model
{
    protected $fillable = [
        'personalization_id',
        'product_id',
        'similarity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function personalization()
    {
        return $this->belongsTo(Personalization::class);
    }
}
