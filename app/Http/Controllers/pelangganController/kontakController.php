<?php

namespace App\Http\Controllers\pelangganController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class kontakController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('content.pelanggan-interface.kontak');
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
    $data['id_user'] = Auth::user()->user_id;
    $data['nama_pengirim'] = $request->nama_pengirim;
    $data['email'] = Auth::user()->email;
    $data['nomor_hp'] = Auth::user()->nomor_hp;
    $data['subjek'] = $request->subjek;
    $data['pesan'] = $request->pesan;
    $data['tanggal'] = today();
    $data['dibaca'] = 0;

    Pesan::create($data);

    return redirect()->route('kontak');
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
