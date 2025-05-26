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
        return true;
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
            'type' => ['required',new Enum(CommentType::class)],
            'creator_identifier' => ['required',Rule::exists($userRepo->getTable(),$userRepo->getModel()->getRouteKeyName())],
            'commentable_id' => ['required','string'],
            'commentable_type' => ['required',Rule::in(\Base::relationMorphMapAlias())],
            'content' => ['required','string','max:400'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => CommentStatus::PENDING->value,
            'creator_identifier' => $this->user()->email,
        ]);
        $this->mergeIfMissing([
            'type' => CommentType::USER_EXPERIENCE->value,
        ]);
    }
}
