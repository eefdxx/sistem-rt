<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreJenisIuranRequest extends FormRequest
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
            'nama_iuran' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'nominal_default' => ['required', 'numeric', 'min:0'],
            'periode' => ['required', 'string', 'max:50'],
            'is_active' => ['boolean']
        ];
    }
}
