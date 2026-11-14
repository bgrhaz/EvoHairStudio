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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');

            $table->bigInteger('user_id');
            $table->string('nama_pegawai');
            $table->string('nomor_hp');
            $table->string('foto_pegawai');
            $table->enum('status_aktif', ['aktif', 'tidak aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
