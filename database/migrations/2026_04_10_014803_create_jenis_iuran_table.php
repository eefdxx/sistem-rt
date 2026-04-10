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
        Schema::create('jenis_iuran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_iuran');
            $table->text('deskripsi')->nullable();
            $table->decimal('nominal_default', 12, 2)->default(0);
            $table->string('periode')->default('bulanan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_iuran');
    }
};
