<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagihanIuranRequest extends FormRequest
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
            'warga_id' => ['required', 'exists:warga,id'],
            'jenis_iuran_id' => ['required', 'exists:jenis_iuran,id'],
            'periode_bulan' => ['required', 'string'],
            'periode_tahun' => ['required', 'numeric'],
            'nominal' => ['required', 'numeric', 'min:0'],
            'jatuh_tempo' => ['nullable', 'date'],
            'keterangan' => ['nullable', 'string']
        ];
    }
}
