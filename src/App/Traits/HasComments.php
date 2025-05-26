<?php

namespace Callmeaf\Comment\App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->hasMany(self::class,'commentable');
    }

    public function approvedComments(): MorphMany
    {
        return $this->comments()->active();
    }

    public function disapprovedComments(): HasMany
    {
        return $this->comments()->inactive();
    }

    public function pendingComments(): HasMany
    {
        return $this->comments()->pendig();
    }
}
