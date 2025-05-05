<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personalization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'input_text',
        'user_profile',
        'recommended_ids',
        'price_filter'
    ];

    protected $casts = [
        'recommended_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
