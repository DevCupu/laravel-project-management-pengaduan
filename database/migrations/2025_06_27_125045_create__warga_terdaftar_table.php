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
        Schema::create('warga_terdaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_warga_terdaftar');
    }
};
