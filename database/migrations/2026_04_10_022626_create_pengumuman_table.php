<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->string('kategori')->default('umum');
            $table->string('status')->default('draft'); // draft, publish
            $table->timestamp('tanggal_publish')->nullable();
            $table->timestamp('tanggal_berakhir')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->string('lampiran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
