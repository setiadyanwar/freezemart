<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    // mass assignment
    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // relationship
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );

        $query->when(
            !empty($filters['categories']) && is_array($filters['categories']),
            function ($query) use ($filters) {
                $query->whereHas('category', function ($q) use ($filters) {
                    $q->whereIn('slug', $filters['categories']);
                });
            }
        );

        $query->when(
            $filters['sort_by'] ?? false,
            function ($query, $sortBy) {
                if ($sortBy === 'oldest') {
                    $query->orderBy('created_at', 'asc');
                } elseif ($sortBy === 'newest') {
                    $query->orderBy('created_at', 'desc');
                } elseif ($sortBy === 'cheapest') {
                    $query->orderBy('price', 'asc');
                } elseif ($sortBy === 'expensive') {
                    $query->orderBy('price', 'desc');
                }
            }
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
