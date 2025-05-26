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
        'creator_identifier',
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
     * @param string|User $creator
     * @return void
     */
    public function scopeOfCreator(Builder $query,$creator)
    {
        if($creator instanceof  Model) {
            $creator = $creator->getRouteKey();
        }
        $query->where('creator_identifier',$creator);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,$userRepo->getModel()->getRouteKeyName(),'creator_identifier');
    }

    /**
     * @param null|string|User $creator
     * @return bool
     */
    public function canSeeBy($creator = null): bool
    {
        if(is_null($creator)) {
            $creator = Auth::user();
        }
        if($creator instanceof  Model) {
            $creator = $creator->getRouteKey();
        }

        return $this->creator_identifier === $creator;
    }
}
