<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
  protected $table = 'user';
  protected $primaryKey = 'user_id';
  public $timestamps = false;
  protected $fillable = [
    'role',
    'username',
    'email',
    'password',
  ];

  protected $hidden = ['password'];
}
