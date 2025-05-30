<?php

namespace Callmeaf\Comment\App\Traits;

use App\Models\User;
use Callmeaf\Comment\App\Models\Comment;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasComments
{
    public function comments(): MorphMany
    {
        /**
         * @var CommentRepoInterface $commentRepo
         */
        $commentRepo = app(CommentRepoInterface::class);
        return $this->morphMany($commentRepo->getModel()::class,'commentable');
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

    abstract public function maxTotalPinnedComments(): int;

    /**
     * @param Comment $comment
     * @return bool
     */
    abstract public function commentCanPinnedBy($comment): bool;

    abstract public function commentableTitle(): string;
}
