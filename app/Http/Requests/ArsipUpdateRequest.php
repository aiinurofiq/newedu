<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'kodeklasifikasi' => ['required', 'max:255', 'string'],
            'jwp_aktif' => ['required', 'max:255', 'string'],
            'jwp_inaktif' => ['required', 'max:255', 'string'],
            'ha_internal' => ['required', 'max:255', 'string'],
            'ha_eksternal' => ['required', 'max:255', 'string'],
            'keterangan_id' => ['required', 'exists:keterangans,id'],
            'jenisarsip_id' => ['required', 'exists:jenisarsips,id'],
            'kkeamanan_id' => ['required', 'exists:kkeamanans,id'],
            'dasarpertimbangan_id' => [
                'required',
                'exists:dasarpertimbangans,id',
            ],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
