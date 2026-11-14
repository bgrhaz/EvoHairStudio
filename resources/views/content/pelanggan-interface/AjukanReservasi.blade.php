@extends('layouts.pelanggan-layout.app')

@section('title', 'Ajukan Reservasi')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold mb-1">Form Pengajuan Reservasi</h4>
        <p class="text-muted mb-0">Lengkapi detail layanan dan jadwal reservasi Anda</p>
      </div>
      <a href="{{ route('halamanPelanggan') }}" class="btn btn-outline-secondary">
        <i class="bx bx-arrow-back me-1"></i> Kembali
      </a>
    </div>

    <div class="row g-4">
      <!-- Kolom Kiri: Profil Barberman yang Dipilih -->
      <div class="col-12 col-md-4">
        <div class="card text-center h-100">
          <div class="card-header">
            <span class="badge bg-label-primary">Barberman Pilihan</span>
          </div>
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="mb-3">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGObwesziwXc9pgxqwuh1F4rMKnD3IbDb0A6K9HFYNHw&s=10"
                alt="Foto Barberman" class="rounded-circle object-fit-cover border border-2 border-primary" width="110"
                height="110">
            </div>
            <h5 class="card-title mb-1">{{ $barberman->nama_pegawai }}</h5>
            <span class="badge bg-label-success mb-2">Aktif</span>
            <p class="text-muted small mb-0">Siap melayani potongan rambut dan perawatan terbaik untuk Anda.</p>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Form Detail Reservasi -->
      <div class="col-12 col-md-8">
        <div class="card h-100">
          <div class="card-header">
            <h5 class="mb-0">Detail Reservasi</h5>
          </div>
          <div class="card-body">
            <form action="#" method="POST">
              @csrf
              <!-- Input tersembunyi untuk ID Barberman -->
              <input type="hidden" name="id_pegawai" value="{{ $barberman->id_pegawai }}">

              <!-- Nama Pelanggan (Otomatis dari user login) -->
              <div class="mb-3">
                <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="namaPelanggan" name="nama_pelanggan"
                  value="{{ Auth::user()->namaLengkap ?? '' }}" placeholder="Masukkan nama lengkap Anda" readonly>
              </div>

              <!-- Pilih Paket Layanan -->
              <div class="mb-3">
                <label for="paketLayanan" class="form-label">Pilih Paket Layanan</label>
                <select class="form-select" id="paketLayanan" name="paket_id" required>
                  <option value="" selected disabled>-- Pilih Paket Layanan --</option>
                  <option value="1">Paket Basic - Rp 45.000 (45 Menit)</option>
                  <option value="2">Paket Premium (Haircut + Wash + Styling) - Rp 65.000 (60 Menit)</option>
                  <option value="3">Kids Haircut - Rp 35.000 (30 Menit)</option>
                  <option value="4">Beard Trim & Shave - Rp 30.000 (30 Menit)</option>
                </select>
              </div>

              <!-- Pilih Tanggal Reservasi -->
              <!-- Tanggal Reservasi Otomatis Hari Ini -->
              <input type="hidden" name="tanggal_reservasi" value="{{ date('Y-m-d') }}">

              <!-- Pilih Jam Reservasi Hari Ini -->
              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <label class="form-label mb-0">
                    Pilih Jam Reservasi <span class="badge bg-label-info ms-1">Hari Ini: {{ date('d M Y') }}</span>
                  </label>
                  <small class="text-muted">Pilih jam yang tersedia</small>
                </div>

                <!-- Contoh Tampilan Statis Sebelum Terhubung Database -->
                <div class="row g-2">
                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam1" value="1" required>
                    <label class="btn btn-outline-primary w-100" for="jam1">09:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <!-- Contoh slot yang sudah dibooking orang lain (disabled) -->
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam2" value="2" disabled>
                    <label class="btn btn-outline-secondary w-100 text-decoration-line-through"
                      for="jam2">10:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam3" value="3" required>
                    <label class="btn btn-outline-primary w-100" for="jam3">11:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam4" value="4" required>
                    <label class="btn btn-outline-primary w-100" for="jam4">13:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam5" value="5" required>
                    <label class="btn btn-outline-primary w-100" for="jam5">14:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam6" value="6" disabled>
                    <label class="btn btn-outline-secondary w-100 text-decoration-line-through"
                      for="jam6">15:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam7" value="7" required>
                    <label class="btn btn-outline-primary w-100" for="jam7">16:00</label>
                  </div>

                  <div class="col-4 col-sm-3">
                    <input type="radio" class="btn-check" name="jadwal_id" id="jam8" value="8" required>
                    <label class="btn btn-outline-primary w-100" for="jam8">19:00</label>
                  </div>
                </div>
              </div>

              <!-- Tombol Aksi -->
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('halamanPelanggan') }}" class="btn btn-outline-secondary">
                  Batal
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-check-circle me-1"></i> Ajukan Reservasi
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
