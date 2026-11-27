<?php

namespace App\Http\Controllers\barbermanController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sertifikat;
use App\Models\Pegawai;

class SertifikatController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user_id = Auth::id();
    $pegawai = Pegawai::where('user_id', $user_id)->first();
    $id_pegawai = $pegawai->id_pegawai;

    $Sertifikat = Sertifikat::where('id_pegawai', $id_pegawai)->get();

    return view('content.barberman-interface.Sertifikat', compact('Sertifikat'));
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
    $user_id = Auth::id();
    $pegawai = Pegawai::where('user_id', $user_id)->first();

    $request->validate([
      'foto' => 'required|image|mimes:png,jpg,jpeg|max:8192'
    ]);

    $path = $request->file('foto')->store('sertifikat', 'public');
    $id_pegawai = $pegawai->id_pegawai;
    $judul = $request->judul;
    $deskripsi = $request->deskripsi;

    Sertifikat::create([
      'foto' => $path,
      'id_pegawai' => $id_pegawai,
      'judul' => $judul,
      'deskripsi' => $deskripsi
    ]);

    return redirect()->route('barberman.sertifikat');
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
