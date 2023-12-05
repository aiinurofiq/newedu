<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', 'string'],
            'writer' => ['required', 'max:255', 'string'],
            'abstract' => ['required', 'max:255', 'string'],
            'status' => ['required', 'boolean'],
            'photo' => ['nullable', 'file'],
            'user_id' => ['required', 'exists:users,id'],
            'topic_id' => ['required', 'exists:topics,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
