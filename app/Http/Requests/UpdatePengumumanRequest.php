<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePengumumanRequest extends FormRequest
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
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:draft,publish'],
            'tanggal_berakhir' => ['nullable', 'date'],
            'lampiran' => ['nullable', 'string', 'max:255'], // Placeholder for future file uploads path if needed
        ];
    }
}
