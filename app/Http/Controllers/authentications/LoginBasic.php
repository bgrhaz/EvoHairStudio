<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function authenticate(Request $request)
  {
    // 1. Validasi input
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);


    // 2. Cek kecocokan data di database
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      $role = Auth::user()->role;
      if ($role == 'admin') {
        return redirect()->route('admin.dashboard');
      } else if ($role == 'barberman') {
        return redirect()->route('barberman.dashboard');
      } else if ($role == 'user') {
        return redirect()->route('halamanUser');
      }
    }

    // 3. Kembalikan ke halaman login jika gagal
    return back()->withErrors([
      'email' => 'Email atau password salah.',
    ])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('login'));
  }
}
