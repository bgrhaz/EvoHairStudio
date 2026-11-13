<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\user;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    $data = $request->only(['role', 'username', 'email']);
    $data['password'] = Hash::make($request->password);
    user::create($data);

    return redirect()->route('login');
  }
}
