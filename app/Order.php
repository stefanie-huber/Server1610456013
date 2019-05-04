<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Order extends Model
{
    protected $fillable = ['total_price', 'state',
        'comment', 'user_id'];

    public function orderlogs(): HasMany
    {
        return $this->hasMany(Orderlog::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps()->withPivot('book_price_at_order');

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}