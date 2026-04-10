<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_iuran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_iuran');
            $table->text('deskripsi')->nullable();
            $table->decimal('nominal_default', 15, 2);
            $table->string('periode'); // bulanan, tahunan, insidental
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_iuran');
    }
};
