<?php

namespace App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\jadwal_barberman;
use App\Models\master_jam;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pegawai;

class BuatAkunBarberman extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('content.admin-interface.tambahAkunBarberman');
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
    $data['role'] = $request->role;
    $data['namaLengkap'] = $request->namaLengkap;
    $data['username'] = $request->username;
    $data['email'] = $request->email;
    $data['nomor_hp'] = $request->nomor_hp;

    $data['password'] =  Hash::make($request->password);
    $user = User::create($data);

    $user_id = $user->user_id;

    $pegawai = Pegawai::create([
      'user_id' => $user_id,
      'nama_pegawai' => $request->namaLengkap,
      'nomor_hp' => $request->nomor_hp,
      'foto_pegawai' => 'belum tersedia',
      'status_aktif' => 'aktif'
    ]);


    $master_jam = master_jam::all();

    foreach ($master_jam as $jam):
      jadwal_barberman::create([
        'id_jam' => $jam->id_jam,
        'id_pegawai' => $pegawai->id_pegawai,
        'jam' => $jam->jam
      ]);
    endforeach;

    return redirect()->route('admin.TambahAkunBarberman');
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
