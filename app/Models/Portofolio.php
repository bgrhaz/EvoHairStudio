<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
  protected $table = 'Portofolio';
  protected $primaryKey = 'id_portofolio';
  public $timestamps = true;
  protected $fillable = [
    'id_pegawai',
    'foto',
    'judul',
    'deskripsi'
  ];
}
