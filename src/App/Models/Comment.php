<?php

namespace Callmeaf\Comment\App\Models;

use App\Models\User;
use Callmeaf\Base\App\Models\BaseModel;
use Callmeaf\Base\App\Traits\Model\HasDate;
use Callmeaf\Base\App\Traits\Model\HasParent;
use Callmeaf\Base\App\Traits\Model\HasStatus;
use Callmeaf\Base\App\Traits\Model\HasType;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Comment extends BaseModel
{
     use SoftDeletes;
     use HasStatus,HasType,HasDate,HasParent;

    protected $fillable = [
        'status',
        'type',
        'parent_id',
        'is_pinned',
        'commentable_id',
        'commentable_type',
        'author_identifier',
        'content'
    ];

    public static function configKey(): string
    {
        return 'callmeaf-comment';
    }

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean',
            ...(self::config()['enums'] ?? []),
        ];
    }

    /**
     * @param Builder $query
     * @param string|User $author
     * @return void
     */
    public function scopeOfAuthor(Builder $query,$author)
    {
        if($author instanceof  Model) {
            $author = $author->getRouteKey();
        }
        $query->where('author_identifier',$author);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,'author_identifier',$userRepo->getModel()->getRouteKeyName());
    }

    /**
     * @param null|string|User $author
     * @return bool
     */
    public function canSeeBy($author = null): bool
    {
        if(is_null($author)) {
            $author = Auth::user();
        }
        if($author instanceof  Model) {
            $author = $author->getRouteKey();
        }

        return $this->author_identifier === $author;
    }
}
