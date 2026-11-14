<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';
  protected $primaryKey = 'id_pegawai';
  public $timestamps = false;
  protected $fillable = [
    'user_id',
    'nama_pegawai',
    'nomor_hp',
    'foto_pegawai',
    'status_aktif'
  ];
}
