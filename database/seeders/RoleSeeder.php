<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->updateOrInsert(
            ['nama_role' => 'admin'],
            [
                'deskripsi' => 'Administrator sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['nama_role' => 'warga'],
            [
                'deskripsi' => 'Pengguna warga',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}