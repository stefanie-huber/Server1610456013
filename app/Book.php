<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Book extends Model
{
    //QueryScopes
    public function scopeFavourite($query)
    {
        return $query->where('rating', '>=', 8);
    }

    protected $fillable = ['isbn', 'title', 'subtitle', 'published',
        'rating', 'description', 'user_id', 'price'];
    //diese Daten dürfen über http geändert werden
    //manche laravel methoden geben auch einen array zurück - Mass assignments


    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
