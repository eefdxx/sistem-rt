<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->integer('rt')->nullable()->change();
            $table->integer('rw')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->string('rt', 5)->nullable()->change();
            $table->string('rw', 5)->nullable()->change();
        });
    }
};