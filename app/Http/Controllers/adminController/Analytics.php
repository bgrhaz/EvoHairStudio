<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;


class Analytics extends Controller
{
  public function index()
  {
    return view('content.admin-interface.dashboards');
  }

  public function akunBarberman()
  {
    $dataBarberman = User::where('role', 'barberman')->get();
    return view('content.admin-interface.akunBarberman', compact('dataBarberman'));
  }
}
