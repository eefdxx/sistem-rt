<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihan_iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga');
            $table->foreignId('jenis_iuran_id')->constrained('jenis_iuran');
            $table->integer('periode_bulan')->nullable();
            $table->integer('periode_tahun');
            $table->decimal('nominal', 15, 2);
            $table->date('jatuh_tempo')->nullable();
            $table->string('status')->default('belum_bayar'); // belum_bayar, proses, lunas, batal
            $table->text('keterangan')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan_iuran');
    }
};
