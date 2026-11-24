<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $DataPesan = Pesan::orderBy('id_pesan', 'desc')->get();
    return view('content.admin-interface.halamanPesan', compact('DataPesan'));
  }

  public function tandaiDibaca($id)
  {
    $pesan = Pesan::findOrFail($id);

    $pesan->update([
      'dibaca' => 1
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Pesan berhasil ditandai sudah dibaca.'
    ]);
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
