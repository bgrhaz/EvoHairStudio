@extends('layouts.pelanggan-layout.app')

@section('title', 'Ajukan Reservasi')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y reservasi-page">
    <!-- Header & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="reservasi-head">
        <h4 class="fw-bold mb-1">Form Pengajuan Reservasi</h4>
        <p class="text-muted mb-0">Lengkapi detail layanan dan jadwal reservasi Anda</p>
      </div>
    </div>

    <div class="row g-4">
      <!-- Kolom Kiri: Profil Barberman yang Dipilih -->
      <div class="col-12 col-md-4">
        <div class="card-reservasi text-center h-100 barber-card">
          <div class="card-header">
            <span class="badge bg-label-primary">Barberman Pilihan</span>
          </div>
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="mb-3">
              <img
                src="{{ $foto?->foto ? asset('storage/' . $foto->foto) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGObwesziwXc9pgxqwuh1F4rMKnD3IbDb0A6K9HFYNHw&s=10' }}"
                alt="Foto Barberman" class="rounded-circle object-fit-cover border border-2 border-primary" width="110"
                height="110">
            </div>
            <h5 class="card-title mb-1">{{ $barberman->nama_pegawai }}</h5>
            <span class="badge bg-label-success mb-2">Aktif</span>
            <div class="barber-description">
              <p>Lorem ipsum dolor sit amet consectetur...</p>

              <p>Facere numquam eius sit modi quos non...</p>

              <p>Nihil doloribus facilis minima adipisci...</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Form Detail Reservasi -->
      <div class="col-12 col-md-8">
        <div class="card h-100 barber-card">
          <div class="card-header">
            <h5 class="mb-0 text-reservasi">Detail Reservasi</h5>
          </div>
          <div class="card-body">

            <form action="{{ route('AjukanReservasi') }}" method="POST">
              @csrf
              <!-- Input tersembunyi untuk ID Barberman -->
              <input type="hidden" name="id_pegawai" value="{{ $barberman->id_pegawai }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">

              <!-- Nama Pelanggan (Otomatis dari user login) -->
              <div class="mb-3">
                <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control reservasi-input" id="namaPelanggan" name="nama_pelanggan"
                  value="{{ Auth::user()->namaLengkap ?? '' }}" placeholder="Masukkan nama lengkap Anda" readonly>
              </div>

              <!-- Pilih Paket Layanan -->
              <div class="mb-3">
                <label for="paketLayanan" class="form-label">Pilih Paket Layanan</label>
                <select class="form-select reservasi-input" id="paketLayanan" name="id_layanan" required>
                  <option value="" selected disabled>-- Pilih Paket Layanan --</option>
                  @foreach ($layanan as $pilihan)
                    <option value="{{ $pilihan->id_layanan }}">{{ $pilihan->nama_layanan }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Pilih Tanggal Reservasi Hari Ini -->
              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <label class="form-label">Pilih Tanggal Reservasi</label>
                  <input type="date" name="tanggal_reservasi" id="tanggal_reservasi"
                    class="form-control d-block width-100 reservasi-input" min="{{ date('Y-m-d') }}"
                    value='{{ date('Y-m-d') }}' required>
                </div>
                <!-- Contoh Tampilan Statis Sebelum Terhubung Database -->

                <div class="row g-2">
                  <small class="text-muted">Pilih jam yang tersedia</small>

                  @foreach ($jadwal as $jam)
                    @if ($jam->id_jadwal)
                      <div class="col-4 col-sm-3">
                        <input type="radio" class="btn-check" name="id_jadwal" id="jadwal-{{ $loop->index }}"
                          value="{{ $jam->id_jadwal }}" data-jadwal="{{ $jam->id_jadwal }}" data-barber-available="1"
                          required>

                        <label class="btn btn-outline-primary w-100" id="label-jadwal-{{ $loop->index }}"
                          for="jadwal-{{ $loop->index }}">
                          {{ $jam->jam }}
                        </label>
                      </div>
                    @else
                      <div class="col-4 col-sm-3">
                        <input type="radio" class="btn-check" name="id_jadwal" id="jadwal-{{ $loop->index }}"
                          value="" data-jadwal="" data-barber-available="0" disabled>

                        <label class="btn btn-outline-danger w-100" id="label-jadwal-{{ $loop->index }}"
                          for="jadwal-{{ $loop->index }}">
                          {{ $jam->jam }}
                        </label>
                      </div>
                    @endif
                  @endforeach
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end mt-2 gap-2">
                  <div class="px-0.5">
                    <a href="{{ route('halamanPelanggan') }}" class="btn btn-outline-secondary reserve-btn">
                      Batal
                    </a>
                  </div>
                  <div class="">
                    <button type="submit" class="reserve-btn">
                      <i class="bx bx-check-circle me-1"></i> Ajukan Reservasi
                    </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5 bg-black rounded">

      <!-- 1. Navigasi Tab -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-pane" type="button"
            role="tab" aria-controls="home-pane" aria-selected="true">Portofolio</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-pane"
            type="button" role="tab" aria-controls="profile-pane" aria-selected="false">Sertifikat</button>
        </li>

      </ul>

      <!-- 2. Konten Tab -->
      <div class="tab-content border border-top-0 p-3 rounded-bottom" id="myTabContent">
        {{-- CONTENT PORTOFOLIO --}}
        <div class="tab-pane fade show active" id="home-pane" role="tabpanel" aria-labelledby="home-tab"
          tabindex="0">

          <div class="card-body portfolio-list">
            <div class="row g-4">
              @foreach ($Portofolio as $portofolio)
                <div class="col-12 col-sm-6 col-lg-4">
                  <div class="portfolio-card">

                    <img src="{{ $portofolio?->foto ? asset('storage/' . $portofolio->foto) : '' }}"
                      alt="{{ $portofolio->judul }}" class="portfolio-image">

                    <div class="portfolio-info ">
                      <h6 class="text-reservasi">{{ $portofolio->judul }}</h6>
                      <p>{{ $portofolio->deskripsi }}</p>
                    </div>

                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        {{-- CONTENT SERTIFIKAT --}}
        <div class="tab-pane fade" id="profile-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

          <div class="card-body portfolio-list">
            <div class="row g-4">
              @foreach ($Sertifikat as $sertifikat)
                <div class="col-12 col-sm-6 col-lg-4">
                  <div class="portfolio-card certificate-card">

                    <img src="{{ $sertifikat?->foto ? asset('storage/' . $sertifikat->foto) : '' }}"
                      alt="{{ $sertifikat->judul }}" class="certificate-image">

                    <div class="portfolio-info">
                      <h6 class="text-reservasi">{{ $sertifikat->judul }}</h6>
                      <p>{{ $sertifikat->deskripsi }}</p>
                    </div>

                  </div>
                </div>
              @endforeach
            </div>
          </div>


        </div>
      </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const tanggalInput = document.getElementById('tanggal_reservasi');

      const urlCekJadwal = @json(route('reservasi.cekJadwal', [
              'id' => $barberman->getKey(),
          ]));

      function cekJadwal() {

        const tanggal = tanggalInput.value;

        if (!tanggal) return;

        fetch(urlCekJadwal + '?tanggal_reservasi=' + encodeURIComponent(tanggal))
          .then(response => {
            if (!response.ok) {
              throw new Error('Gagal mengambil data jadwal');
            }

            return response.json();
          })
          .then(data => {

            const waktuTerpakai = data.map(Number);

            document.querySelectorAll(
              '[data-barber-available="1"]'
            ).forEach(input => {

              const idJadwal = Number(input.dataset.jadwal);

              const label = document.getElementById(
                'label-' + input.id
              );

              const sudahDipesan = waktuTerpakai.includes(idJadwal);

              if (sudahDipesan) {

                input.disabled = true;
                input.checked = false;

                label.classList.remove('btn-outline-primary');
                label.classList.add('btn-outline-danger');

              } else {

                input.disabled = false;

                label.classList.remove('btn-outline-danger');
                label.classList.add('btn-outline-primary');

              }

            });

          })
          .catch(error => {
            console.error('Gagal memeriksa jadwal:', error);
          });
      }

      // Ketika pengguna memilih tanggal berbeda
      tanggalInput.addEventListener('change', cekJadwal);

      // Ketika halaman pertama kali dibuka
      cekJadwal();

    });
  </script>
@endsection
