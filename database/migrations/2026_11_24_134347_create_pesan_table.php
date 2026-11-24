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
    Schema::create('pesan', function (Blueprint $table) {
      $table->id('id_pesan');
      $table->string('id_user');
      $table->string('nama_pengirim');
      $table->string('email');
      $table->string('nomor_hp');
      $table->string('subjek');
      $table->text('pesan');
      $table->date('tanggal');
      $table->tinyInteger('dibaca');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pesan');
  }
};
