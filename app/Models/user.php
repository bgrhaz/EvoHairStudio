<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $table = 'user';
  protected $primaryKey = 'user_id';
  public $timestamps = false;
  protected $fillable = [
    'role',
    'namaLengkap',
    'username',
    'email',
    'nomor_hp',
    'password',
  ];

  protected $hidden = ['password'];
}
