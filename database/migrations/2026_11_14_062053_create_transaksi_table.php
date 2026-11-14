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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');

            $table->bigInteger('id_reservasi');
            $table->bigInteger('id_pegawai');
            $table->bigInteger('id_admin');
            $table->bigInteger('id_kategori');
            $table->string('nama_pelanggan');
            $table->string('nomor_antrian');
            $table->date('tanggal_transaksi');
            $table->decimal('total_bayar');
            $table->string('metode_pembayaran');
            $table->decimal('uang_dibayar');
            $table->decimal('kembalian');
            $table->enum('metode_pemesanan', ['Online', 'Walk In']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
