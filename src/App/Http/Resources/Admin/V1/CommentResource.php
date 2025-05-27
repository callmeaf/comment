<?php

namespace Callmeaf\Comment\App\Http\Resources\Admin\V1;

use Callmeaf\Comment\App\Models\Comment;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Comment $resource
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        /**
         * @var CommentRepoInterface $commentRepo
         */
        $commentRepo = app(CommentRepoInterface::class);
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'commentable_id' => $this->commentable_id,
            'commentable_type' => $this->commentable_type,
            'author_identifier' => $this->author_identifier,
            'status' => $this->status,
            'status_text' => $this->statusText,
            'type' => $this->type,
            'type_text' => $this->typeText,
            'is_pinned' => $this->is_pinned,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'created_at_text' => $this->createdAtText(),
            'updated_at' => $this->updated_at,
            'updated_at_text' => $this->updatedAtText(),
            'deleted_at' => $this->deleted_at,
            'deleted_at_text' => $this->deletedAtText(),
            'author' => $userRepo->toResource($this->whenLoaded('author')),
            'replies' => $commentRepo->toResourceCollection($this->whenLoaded('children')),
        ];
    }
}
