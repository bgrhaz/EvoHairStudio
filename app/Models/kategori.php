<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
  protected $table = 'kategori';
  protected $primaryKey = 'id_kategori';
  public $timestamps = false;

  protected $fillable = [
    'nama_kategori',
    'detail_kategori',
    'harga',
    'durasi',
  ];
}
