<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pelanggan;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

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
    Pelanggan::create([
      'user_id' => $user_id,
      'nama_pelanggan' => $request->namaLengkap,
      'email' => $request->email,
      'nomor_hp' => $request->nomor_hp,
    ]);

    return redirect()->route('login');
  }
}
