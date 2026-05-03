<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('kategori_laporan_id')->constrained('kategori_laporan');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang');
            // Status: menunggu → diproses → selesai | ditolak
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamp('tanggal_laporan')->useCurrent();
            $table->foreignId('ditinjau_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('tanggal_ditinjau')->nullable();
            $table->string('lampiran')->nullable(); // path file/foto
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
