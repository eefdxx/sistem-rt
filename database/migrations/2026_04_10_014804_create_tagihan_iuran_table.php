<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tagihan_iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('jenis_iuran_id')->constrained('jenis_iuran')->cascadeOnDelete();
            $table->string('periode_bulan');
            $table->integer('periode_tahun');
            $table->decimal('nominal', 12, 2);
            $table->date('jatuh_tempo')->nullable();
            $table->enum('status', ['belum_dibayar', 'lunas', 'proses_verifikasi'])->default('belum_dibayar');
            $table->text('keterangan')->nullable();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_iuran');
    }
};
