<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
  protected $table = 'pesan';
  protected $primaryKey = 'id_pesan';
  public $timestamps = true;
  protected $fillable = [
    'id_user',
    'nama_pengirim',
    'email',
    'nomor_hp',
    'subjek',
    'pesan',
    'tanggal',
    'dibaca'
  ];
}
