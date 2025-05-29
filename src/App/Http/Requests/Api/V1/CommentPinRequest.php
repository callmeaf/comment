<?php

namespace Callmeaf\Comment\App\Http\Requests\Api\V1;

use Callmeaf\Comment\App\Models\Comment;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Illuminate\Foundation\Http\FormRequest;

class CommentPinRequest extends FormRequest
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
        return $comment->resource->canPinBy($this->user()) && $comment->resource->isActive() && $comment->resource->isParent();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_pinned' => ['required','boolean'],
        ];
    }
}
