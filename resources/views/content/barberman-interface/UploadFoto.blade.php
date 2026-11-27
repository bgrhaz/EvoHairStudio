@extends('layouts/barberman-layout/app')
@section('title', 'Dashboard - Analytics')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection
@section('page-script')
  @vite(['resources/assets/js/dashboards-analytics.js'])
@endsection

@section('content')

  <div class="row g-3">

    <div class="col-md-6">
      <div class="card m-2 p-3 h-100 card-profil">
        <h5 class="card-title">Foto Profil</h5>
        <img
          src="{{ $foto?->foto ? asset('storage/' . $foto->foto) : 'https://i.pinimg.com/originals/75/4d/35/754d3502a5b2bd7007e4eef9fc8fac25.jpg' }}"
          alt="" class="img-profil">
      </div>
    </div>

    <div class="col-md-6">
      <div class="card d-flex align-items-center m-2 p-3 h-100">
        <h5>Ganti Foto Profil</h5>
        <p>Agar tampilan makin kece</p>
        <form action="{{ route('barberman.foto.upload') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card d-flex align-items-center p-3">
            <label class="form-label d-block text-center mt-2" for="foto">Unggah foto</label>
            <input type="file" name="foto" class="form-control">
            <button class="btn btn-success align-self-end mt-2">Simpan</button>
          </div>
        </form>
        <p class="text-danger mt-2">Format (png/jpg/jpeg) | Max : 2mb</p>
      </div>

    </div>

  </div>

@endsection
