<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DemoWargaSeeder extends Seeder
{
    public function run(): void
    {
        $wargaRole = DB::table('roles')->where('nama_role', 'warga')->first();

        if (!$wargaRole) {
            return;
        }

        // 1. Buat User Akun Warga
        $user = User::updateOrCreate(
            ['email' => 'warga@gmail.com'],
            [
                'name' => 'Bapak Warga Demo',
                'password' => Hash::make('warga12345'),
                'role_id' => $wargaRole->id,
            ]
        );

        // 2. Mapping Profil Warga ke Sistem Kependudukan
        // Kita butuh keluarga dulu agar tidak error
        $keluargaId = DB::table('keluarga')->insertGetId([
            'no_kk' => '3201234567890123',
            'alamat' => 'Jl. Mawar Merah No. 10',
            'rt' => '001',
            'rw' => '005',
            'kode_pos' => '12345',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $warga = Warga::create([
            'user_id' => $user->id,
            'keluarga_id' => $keluargaId,
            'nik' => '3201234567890001',
            'nama_lengkap' => 'Bapak Warga Demo',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Karyawan Swasta',
            'no_hp' => '081234567890',
            'status_keluarga' => 'kepala_keluarga',
            'status_warga' => 'warga_tetap',
            'tanggal_masuk' => now()->format('Y-m-d'),
        ]);

        // Perbarui ID Kepala Keluarga
        DB::table('keluarga')->where('id', $keluargaId)->update(['kepala_keluarga_id' => $warga->id]);
    }
}
