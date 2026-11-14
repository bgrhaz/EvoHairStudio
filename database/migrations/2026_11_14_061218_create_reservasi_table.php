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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id('reservasi_id');

            $table->string('kode_reservasi');
            $table->bigInteger('id_pelanggan');
            $table->bigInteger('id_pegawai');
            $table->bigInteger('id_kategori');
            $table->date('tanggal_reservasi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->decimal('total_bayar');
            $table->enum('status_reservasi', ['selesai', 'belum selesai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
