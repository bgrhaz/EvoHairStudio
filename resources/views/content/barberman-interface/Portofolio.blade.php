@extends('layouts/barberman-layout/app')
@section('title', 'Pengaturan Akun')

@section('content')
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Pengaturan Akun</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('barberman.UbahAKun') }}" method="POST">
            @csrf

            <div class="row g-4">

              <div class="col-md-6">
                <label for="username" class="form-label">Ganti Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Rendi123" required>
              </div>

              {{-- Baris 3: Nomor HP --}}
              <div class="col-md-6">
                <label for="nomor_hp" class="form-label">Ganti Nomor HP</label>
                <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" placeholder="083175012283"
                  required>
              </div>

              {{-- Baris 2: Kata Sandi & Ulangi Kata Sandi --}}
              <div class="col-md-6">
                <label for="password" class="form-label">Ganti Kata Sandi</label>
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
              <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
