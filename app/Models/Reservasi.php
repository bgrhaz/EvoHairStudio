<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
  protected $table = 'reservasi';
  protected $primaryKey = 'id_reservasi';
  public $timestamps = false;
  protected $fillable = [
    'kode_reservasi',
    'id_pelanggan',
    'id_pegawai',
    'id_kategori',
    'tanggal_reservasi',
    'jam_mulai',
    'jam_selesai',
    'total_bayar',
    'status_reservasi',
  ];
}
