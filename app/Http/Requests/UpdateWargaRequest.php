<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $wargaId = $this->route('warga')->id ?? null;

        return [
            'user_id' => [
                'nullable',
                'exists:users,id',
                Rule::unique('warga', 'user_id')->ignore($wargaId),
            ],
            'keluarga_id' => ['required', 'exists:keluarga,id'],
            'nik' => [
                'required',
                'digits:16',
                Rule::unique('warga', 'nik')->ignore($wargaId),
            ],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'agama' => ['nullable', 'string', 'max:50'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'email_pribadi' => ['nullable', 'email', 'max:100'],
            'status_keluarga' => ['required', 'in:kepala_keluarga,istri,anak,anggota_lain'],
            'status_warga' => ['required', 'in:tetap,kontrak,pindah,tidak_aktif'],
            'tanggal_masuk' => ['nullable', 'date'],
            'foto' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'keluarga_id.required' => 'Keluarga wajib dipilih.',
            'keluarga_id.exists' => 'Data keluarga tidak valid.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'status_keluarga.required' => 'Status keluarga wajib dipilih.',
            'status_warga.required' => 'Status warga wajib dipilih.',
        ];
    }
}