<?php

namespace Callmeaf\Comment\App\Http\Requests\Admin\V1;

use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Enums\CommentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CommentUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'type' => ['required',new Enum(CommentType::class)],
            'status' => ['required',new Enum(CommentStatus::class)],
            'content' => ['required','string','max:700'],
        ];
    }
}
