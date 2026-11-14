<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class BuatAkunAdmin extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('content.admin-interface.tambahAkunAdmin');
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
    Admin::create([
      'user_id' => $user_id,
      'nama_admin' => $request->namaLengkap,
      'email' => $request->email,
      'nomor_hp' => $request->nomor_hp,
      'foto_admin' => 'belum tersedia'
    ]);

    return redirect()->route('admin.TambahAkunAdmin');
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
