<?php

namespace App\Http\Controllers\pelangganController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PesanPelangganController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user_id = Auth::id();
    $Pesan = Pesan::where('id_user', $user_id)
      ->where('nama_pengirim', 'Sistem')
      ->orderBy('id_pesan', 'desc')
      ->get();
    return view('content.pelanggan-interface.Pesan', compact('Pesan'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
