<?php

namespace App\Http\Controllers\barbermanController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PengaturanAkunBarberman extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('content.barberman-interface.PengaturanAkun');
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
    $data['username'] = $request->username;
    $data['nomor_hp'] = $request->nomor_hp;
    $data['password'] = Hash::make($request->password);

    $user_id = Auth::id();

    $user = User::find($user_id);
    $user->update($data);

    $pegawai = Pegawai::where('user_id', $user_id)->firstOrFail();
    $pegawai->update([
      'nomor_hp' => $data['nomor_hp']
    ]);

    return redirect()->route('barberman.PengaturanAkun');
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
