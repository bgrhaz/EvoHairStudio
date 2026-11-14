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
    Schema::create('user', function (Blueprint $table) {
      $table->id('user_id');

      $table->enum('role', ['admin', 'user', 'barberman']);
      $table->string('namaLengkap', 50);
      $table->string('username', 50)->unique();
      $table->string('email', 50)->unique();
      $table->string('nomor_hp', 20);
      $table->string('password');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('user');
  }
};
