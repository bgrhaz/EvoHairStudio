<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tranksaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

   protected $fillable = [
    'id_reservasi',
    'id_pegawai',
    'id_admin',
    'id_kategori',
    'nama_pelanggan',
    'nomor_antrian',
    'tanggal_transaksi',
    'total_bayar',
    'metode_pembayaran',
    'uang_dibayar',
    'kembalian',
    'metode_pemesanan'
   ];
}
