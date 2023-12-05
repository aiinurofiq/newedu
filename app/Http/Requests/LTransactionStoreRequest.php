<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LTransactionStoreRequest extends FormRequest
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
            'uuid' => ['required', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'learning_id' => ['required', 'exists:learnings,id'],
            'lpayment_id' => ['required', 'exists:lpayments,id'],
            'coupon_id' => ['required', 'exists:coupons,id'],
            'totalamount' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ];
    }
}
