<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LearningUpdateRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'string'],
            'type' => ['required', 'in:0,1,2'],
            'price' => ['nullable', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
            'categorylearn_id' => ['required', 'exists:categorylearns,id'],
            'level' => ['required', 'in:0,1,2,3'],
            'ispublic' => ['required', 'boolean'],
        ];
    }
}
