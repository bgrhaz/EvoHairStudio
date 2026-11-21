@extends('layouts.pelanggan-layout.app')

@section('title', 'Halaman Utama Pelanggan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Halaman & Tombol Logout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold mb-1">Pilih Barberman</h4>
        <p class="text-muted mb-0">Silakan pilih barberman yang tersedia untuk mengajukan reservasi</p>
      </div>
      {{-- <form action="{{ route('auth-logout-basic') }}" method="GET">

        <button type="submit" class="btn btn-outline-danger btn-sm">
          <i class="bx bx-power-off me-1"></i> Logout
        </button>
      </form> --}}
    </div>

    <!-- Daftar Card Barberman Aktif -->
    <div class="row g-4">

      @forelse ($barbermanAktif as $barberman)
        <!-- Card Barberman 1 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-between">
              <div class="w-100">
                <!-- Foto Profil -->
                <div class="mb-3">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGObwesziwXc9pgxqwuh1F4rMKnD3IbDb0A6K9HFYNHw&s=10"
                    alt="Foto Barberman" class="rounded-circle object-fit-cover border border-2 border-primary"
                    width="95" height="95">
                </div>

                <!-- Nama & Status -->
                <h5 class="card-title mb-1">{{ $barberman->nama_pegawai }}</h5>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit asperiores enim dolor, assumenda
                  repellendus dolorem possimus facilis mollitia facere beatae ab corporis perferendis repudiandae id, odio
                  vitae sint accusamus at?</small><br>
                <span class="badge bg-label-success mb-3">Aktif</span>
              </div>

              <!-- Button Ajukan Reservasi -->
              <a href="{{ route('HalamanReservasi', $barberman->id_pegawai) }}" class="btn btn-primary w-100">
                <i class="bx bx-calendar-plus me-1"></i> Ajukan Reservasi
              </a>
            </div>
          </div>
        </div>
      @empty
      @endforelse

    </div>
  </div>
@endsection
