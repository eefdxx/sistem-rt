<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamp('tanggal_mulai');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->string('lokasi');
            $table->integer('kuota')->nullable();
            $table->string('status')->default('mendatang'); // mendatang, berjalan, selesai, batal
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
