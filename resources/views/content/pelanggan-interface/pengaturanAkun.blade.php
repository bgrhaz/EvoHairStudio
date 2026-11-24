@extends('layouts.pelanggan-layout.app')

@section('title', 'Pengaturan Akun')

@section('content')

  <div class="row gy-6">
    <div class="col-12">
      <div class="card account-settings">
        <div class="card-header">
          <div>
            <h5 class="mb-1">Pengaturan Akun</h5>
            <p class="text-muted mb-0">
              Kelola informasi akun dan keamanan Anda.
            </p>
          </div>
        </div>

        <div class="card-body">
          <form action="{{ route('update') }}" method="POST">
            @csrf

            <div class="row g-4">

              <div class="col-md-6">
                <label for="username" class="form-label">
                  Ganti Username
                </label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Rendi123" required>
              </div>

              <div class="col-md-6">
                <label for="nomor_hp" class="form-label">
                  Ganti Nomor HP
                </label>
                <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" placeholder="083175012283"
                  required>
              </div>

              <div class="col-md-6">
                <label for="password" class="form-label">
                  Ganti Kata Sandi
                </label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                  required>
              </div>

              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">
                  Ulangi Kata Sandi
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                  placeholder="••••••••" required>
              </div>

            </div>

            <div class="account-actions mt-4">
              <button type="submit" class="btn btn-save-account">
                <i class="ti ti-device-floppy me-1"></i>
                Simpan Perubahan
              </button>

              <button type="reset" class="btn btn-reset-account">
                Reset
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
