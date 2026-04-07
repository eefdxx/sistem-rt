<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeluargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_kk' => ['required', 'digits:16', 'unique:keluarga,no_kk'],
            'alamat' => ['required', 'string'],
            'rt' => ['nullable', 'numeric'],
            'rw' => ['nullable', 'numeric'],
            'kode_pos' => ['nullable', 'numeric'],
            'kepala_keluarga_id' => ['nullable', 'exists:warga,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.digits' => 'Nomor KK harus 16 digit.',
            'no_kk.unique' => 'Nomor KK sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.numeric' => 'RT harus berupa angka.',
            'rw.numeric' => 'RW harus berupa angka.',
            'kode_pos.numeric' => 'Kode Pos harus berupa angka.',
            'kepala_keluarga_id.exists' => 'Kepala keluarga tidak valid.',
        ];
    }
}