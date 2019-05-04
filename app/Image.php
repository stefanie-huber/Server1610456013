<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Image extends Model
{
    protected $fillable = [
        'url', 'title'
    ];


    /**
     * book has many images
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
