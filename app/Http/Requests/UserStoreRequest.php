<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'uuid' => ['nullable', 'unique:users,uuid', 'max:255'],
            'kopeg' => ['required', 'unique:users,kopeg', 'max:255', 'string'],
            'nik' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'religion_id' => ['required', 'exists:religions,id'],
            'address' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'npwp' => ['required', 'max:255', 'string'],
            'tribe_id' => ['required', 'exists:tribes,id'],
            'bloodtype_id' => ['required', 'exists:bloodtypes,id'],
            'marital_id' => ['required', 'exists:maritals,id'],
            'password' => ['required'],
            'profile_photo_path' => ['image', 'max:1024', 'nullable'],
            'roles' => 'array',
            'bumnsectors' => ['array'],
            'bumnclasses' => ['array'],
        ];
    }
}
