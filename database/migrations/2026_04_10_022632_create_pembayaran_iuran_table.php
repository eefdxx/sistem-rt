<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran_iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_iuran_id')->constrained('tagihan_iuran');
            $table->foreignId('warga_id')->constrained('warga');
            $table->timestamp('tanggal_bayar');
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('metode_pembayaran')->default('tunai');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status_verifikasi')->default('menunggu'); // menunggu, disetujui, ditolak
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users');
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iuran');
    }
};
