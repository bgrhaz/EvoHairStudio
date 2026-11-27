@extends('layouts/barberman-layout/app')
@section('title', 'Pengaturan Akun')

@section('content')
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Sertifikat</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('barberman.sertifikat.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
              <label for="username" class="form-label">Tambah Sertifikat</label>
              <input type="file" id="foto" name="foto" class="form-control" required>
              <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul" required>
              <input type="text" class="form-control-lg" name="deskripsi" placeholder="Masukkan Deskripsi" required>
            </div>
            {{-- Tombol Submit --}}
            <div class="mt-5">
              <button type="submit" class="btn btn-primary me-2">Unggah</button>
              <button type="reset" class="btn btn-outline-secondary">Hapus</button>
            </div>
          </form>
        </div>
      </div>

      {{-- <div class="container mt-5">

        <!-- 1. Navigasi Tab -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-pane" type="button"
              role="tab" aria-controls="home-pane" aria-selected="true">Home</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-pane" type="button"
              role="tab" aria-controls="profile-pane" aria-selected="false">Profile</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-pane" type="button"
              role="tab" aria-controls="contact-pane" aria-selected="false">Contact</button>
          </li>
        </ul>

        <!-- 2. Konten Tab -->
        <div class="tab-content border border-top-0 p-3 rounded-bottom" id="myTabContent">
          <div class="tab-pane fade show active" id="home-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <h4>Konten Home</h4>
            <p>Ini adalah isi dari tab Home.</p>
          </div>
          <div class="tab-pane fade" id="profile-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h4>Konten Profile</h4>
            <p>Ini adalah isi dari tab Profile.</p>
          </div>
          <div class="tab-pane fade" id="contact-pane" role="tabpanel" aria-labelledby="contact-tab">
            <h4>Konten Contact</h4>
            <p>Ini adalah isi dari tab Contact.</p>
          </div>
        </div>

      </div> --}}

      <div class="card-body mt-5">
        <div class="row">
          @foreach ($Sertifikat as $sertifikat)
            <div class="">
              <div class="card-body border rounded object-fit-contain portofolio-content">
                <img src="{{ $sertifikat?->foto ? asset('storage/' . $sertifikat->foto) : '' }}" alt=""
                  class="card-img-top rounded" style="height: 350px;">
                <h6 class="card-header mt-2 mx-2">{{ $sertifikat->judul }}</h6>
                <p class="hero-description mx-2">{{ $sertifikat->deskripsi }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>



    </div>
  </div>

@endsection
