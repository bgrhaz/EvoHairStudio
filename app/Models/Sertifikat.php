<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
  protected $table = 'sertifikat';
  protected $primaryKey = 'id_sertifikat';
  public $timestamps = true;
  protected $fillable = [
    'id_pegawai',
    'foto',
    'judul',
    'deskripsi'
  ];
}
