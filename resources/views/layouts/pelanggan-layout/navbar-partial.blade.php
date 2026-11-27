@php
  use Illuminate\Support\Facades\Auth;
@endphp

<div class="navbar-container">

  <div class="hero-title brand-dimensi d-none d-md-block">
    <h4>DIMENSI &nbsp; EVO &nbsp; HAIR &nbsp; STUDIO </h4>
  </div>

  <nav class="navbar-button">

    <a href="/" class="btn-pelanggan">
      <span>Home</span>
    </a>

    <a href="{{ route('kontak') }}" class="btn-pelanggan">
      <span>Kontak</span>
    </a>

    <a href="{{ route('PesanPelanggan') }}" class="btn-pelanggan">
      <span>Pesan</span>
    </a>


    <div class="profil-wrapper" id="profilWrapper">

      <div class="hidden" id="hidden-container">
        <a href="" class="btn-pelanggan profil-pelanggan">
          <i class="fa-solid fa-chevron-down"></i>
          <span>Profil</span>
        </a>

        <a href="{{ route('pengaturanAkun') }}" class="btn-pelanggan tersembunyi" id="btnPengaturan">
          <span>Pengaturan</span>
        </a>

        <a href="{{ route('auth-logout-basic') }}" class="btn-pelanggan tersembunyi2" id="btnKeluar">
          <span>Keluar</span>
        </a>
      </div>


    </div>
  </nav>

</div>

</div>
