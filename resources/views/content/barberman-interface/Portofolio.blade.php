@extends('layouts/barberman-layout/app')
@section('title', 'Pengaturan Akun')

@section('content')
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Portofolio</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('barberman.portofolio.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
              <label for="username" class="form-label">Tambah Portofolio</label>
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



      <div class="card-body mt-5">
        <div class="row">
          @foreach ($Portofolio as $portofolio)
            <div class="col-sm-4 mb-4">
              <div class="card-body border rounded object-fit-contain portofolio-content">
                <img src="{{ $portofolio?->foto ? asset('storage/' . $portofolio->foto) : '' }}" alt=""
                  class="card-img-top object-fit-cover rounded" style="height: 350px;">
                <h6 class="card-header mt-2 mx-2">{{ $portofolio->judul }}</h6>
                <p class="hero-description mx-2">{{ $portofolio->deskripsi }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>



    </div>
  </div>

@endsection
