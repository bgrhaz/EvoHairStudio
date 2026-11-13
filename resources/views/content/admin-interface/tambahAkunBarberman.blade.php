@extends('layouts/admin-layout/app')
@section('title', 'Tambah Akun Barberman')

@section('content')
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Akun Barberman</h5>
        </div>

        <div class="card-body">
          <form action="" method="POST">
            @csrf
            <input type="hidden" name="role" value="barberman">

            <div class="row g-4">
              {{-- Baris 1: Username & Email --}}
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username"
                  required>
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="contoh@email.com"
                  required>
              </div>

              {{-- Baris 2: Kata Sandi & Ulangi Kata Sandi --}}
              <div class="col-md-6">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                  required>
              </div>

              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Ulangi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                  placeholder="••••••••" required>
              </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-5">
              <button type="submit" class="btn btn-primary me-2">Buat Akun</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
