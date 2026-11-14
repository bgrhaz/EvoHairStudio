<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_jam extends Model
{
    protected $table = 'master_jam';
    protected $primaryKey = 'id_jam';
    public $timestamps = false;

    protected $fillable = [
      'jam'
    ];
}
