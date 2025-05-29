<?php

namespace Callmeaf\Comment\App\Http\Requests\Api\V1;

use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Enums\CommentType;
use Callmeaf\Comment\App\Models\Comment;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * @var CommentRepoInterface $commentRepo
         */
        $commentRepo = app(CommentRepoInterface::class);
        $comment = $commentRepo->findById($this->route('comment'));
        return $comment->resource->canSeeBy($this->user()) && !$comment->resource->isActive();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(UserRepoInterface $userRepo): array
    {
        return [
            'status' => ['required',new Enum(CommentStatus::class)],
            'content' => ['required','string','max:700'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => CommentStatus::PENDING->value,
        ]);
    }
}
