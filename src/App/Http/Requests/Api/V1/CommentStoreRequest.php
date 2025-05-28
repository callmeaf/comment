<?php

namespace Callmeaf\Comment\App\Http\Requests\Api\V1;

use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Enums\CommentType;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($parentId = $this->get('parent_id')) {
            /**
             * @var CommentRepoInterface $commentRepo
             */
            $commentRepo = app(CommentRepoInterface::class);
            $comment = $commentRepo->findById($parentId);

            return $comment->resource->isParent();
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(UserRepoInterface $userRepo,CommentRepoInterface $commentRepo): array
    {
        return [
            'status' => ['required',new Enum(CommentStatus::class)],
            'type' => ['nullable',new Enum(CommentType::class)],
            'parent_id' => ['nullable',Rule::exists($commentRepo->getTable(),$commentRepo->getModel()->getRouteKeyName())],
            'is_pinned' => ['required','boolean'],
            'author_identifier' => ['required',Rule::exists($userRepo->getTable(),$userRepo->getModel()->getRouteKeyName())],
            'commentable_id' => ['required','string'],
            'commentable_type' => ['required',Rule::in(\Base::relationMorphMapAlias())],
            'content' => ['required','string','max:700'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => CommentStatus::PENDING->value,
            'author_identifier' => $this->user()->email,
        ]);
        $this->mergeIfMissing([
            'is_pinned' => false,
        ]);
        if(! $this->get('parent_id')) {
            $this->mergeIfMissing([
                'type' => CommentType::USER_EXPERIENCE->value,
            ]);
        }
    }
}
