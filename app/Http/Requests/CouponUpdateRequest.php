<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string'],
            'cutprice' => ['required', 'numeric'],
            'typecut' => ['required', 'in:percentage,nominal'],
            'maxcut' => ['required', 'numeric'],
            'maxusage' => ['required', 'numeric'],
            'expireddate' => ['required', 'date'],
        ];
    }
}
