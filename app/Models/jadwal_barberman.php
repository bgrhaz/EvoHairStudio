<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_barberman extends Model
{
    protected $table = 'jadwal_barberman';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = false;

    protected $fillable = [
      'id_jam',
      'id_pegawai',
      'jam'
    ];
}
