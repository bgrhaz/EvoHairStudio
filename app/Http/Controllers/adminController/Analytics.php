<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    return view('content.admin-interface.dashboards');
  }

  public function akunBarberman()
  {
    $dataBarberman = user::where('role', 'barberman')->get();
    return view('content.admin-interface.akunBarberman', compact('dataBarberman'));
  }

  public function TambahAkunBarberman()
  {
    $dataBarberman = user::where('role', 'barberman')->get();
    return view('content.admin-interface.tambahAkunBarberman', compact('dataBarberman'));
  }
}
