<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriLaporanSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Kebersihan Lingkungan',  'deskripsi' => 'Sampah menumpuk, selokan mampet, atau area kotor di lingkungan RT.'],
            ['nama_kategori' => 'Keamanan Lingkungan',    'deskripsi' => 'Tindakan mencurigakan, pencurian, atau gangguan keamanan di lingkungan RT.'],
            ['nama_kategori' => 'Kerusakan Fasilitas',    'deskripsi' => 'Fasilitas umum seperti jalan, lampu, atau sarana RT yang rusak dan perlu perbaikan.'],
            ['nama_kategori' => 'Gangguan Ketertiban',    'deskripsi' => 'Kebisingan, konflik antar warga, atau pelanggaran aturan lingkungan.'],
            ['nama_kategori' => 'Administrasi & Surat',   'deskripsi' => 'Permasalahan terkait pengurusan dokumen atau surat dari RT.'],
            ['nama_kategori' => 'Lainnya',                'deskripsi' => 'Laporan atau pengaduan yang tidak termasuk kategori di atas.'],
        ];

        foreach ($categories as $cat) {
            DB::table('kategori_laporan')->updateOrInsert(
                ['nama_kategori' => $cat['nama_kategori']],
                $cat
            );
        }
    }
}
