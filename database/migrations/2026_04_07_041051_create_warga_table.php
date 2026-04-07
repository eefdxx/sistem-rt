<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->nullOnDelete();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email_pribadi')->nullable();
            $table->string('status_keluarga');
            $table->string('status_warga');
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Add foreign key for kepala_keluarga_id in keluarga table
        Schema::table('keluarga', function (Blueprint $table) {
            $table->foreign('kepala_keluarga_id')->references('id')->on('warga')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropForeign(['kepala_keluarga_id']);
        });
        
        Schema::dropIfExists('warga');
    }
};
