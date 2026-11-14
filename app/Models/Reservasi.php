<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
  protected $table = 'reservasi';
  protected $primaryKey = 'id_reservasi';
  public $timestamps = true;
  protected $fillable = [
    'kode_reservasi',
    'id_pelanggan', // diambil dari user_id
    'id_pegawai', //sudah
    'id_layanan', //sudah
    'tanggal_reservasi', //sudah
    'jam_mulai', //sudah - diambil dari id_jadwal
    'jam_selesai', // jam ditambah durasi
    'total_bayar', // diambil dari id_layanan -> harga
    'status_reservasi',
  ];

  protected static function booted()
  {
    static::creating(function ($reservasi) {
      $today = Carbon::today(); // Mengambil tanggal hari ini

      // Cari reservasi terakhir KHUSUS untuk hari ini
      $lastReservasi = self::whereDate('created_at', $today)
        ->orderBy('id_reservasi', 'desc') // ganti 'id' jika primary key Anda 'id_reservasi'
        ->first();

      // Jika hari ini sudah ada antrian, ambil 3 digit terakhir lalu tambah 1. Jika belum, mulai dari 1.
      $nextNumber = $lastReservasi
        ? ((int) substr($lastReservasi->kode_reservasi, -3)) + 1
        : 1;

      // Format hasil: A-001, A-002, dst. (atau ganti 'A-' dengan 'RSV-' . date('Ymd') . '-')
      $reservasi->kode_reservasi = 'A-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    });
  }
}
