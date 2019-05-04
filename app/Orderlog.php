<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Orderlog extends Model
{
    protected $fillable = [
        'state',
        'comment'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class)->withTimestamps();
    }
}
