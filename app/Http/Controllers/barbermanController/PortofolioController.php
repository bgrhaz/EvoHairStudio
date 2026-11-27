<?php

namespace App\Http\Controllers\barbermanController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use App\Models\Portofolio;

class PortofolioController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user_id = Auth::id();
    $pegawai = Pegawai::where('user_id', $user_id)->first();
    $id_pegawai = $pegawai->id_pegawai;
    $Portofolio = Portofolio::where('id_pegawai', $id_pegawai)->get();

    return view('content.barberman-interface.Portofolio', compact('Portofolio'));
  }


  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'foto' => 'required|image|mimes:jpg,jpeg,png|max:8192'
    ]);

    $user_id = Auth::id();
    $pegawai = Pegawai::where('user_id', $user_id)->first();

    $judul = $request->judul;
    $deskripsi = $request->deskripsi;
    $id_pegawai = $pegawai->id_pegawai;

    $path = $request->file('foto')->store('portofolio', 'public');

    Portofolio::create([
      'id_pegawai' => $id_pegawai,
      'foto' => $path,
      'judul' => $judul,
      'deskripsi' => $deskripsi
    ]);

    return redirect()->route('barberman.protofolio');
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
