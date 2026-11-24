@extends('layouts.pelanggan-layout.app')

@section('title', 'DIMENSI EVO HAIR STUDIO')

@section('content')

  <div class="user-home">

    <!-- HERO -->
    <section class="hero-section" id="home">
      <span class="hero-tag">✦ Good Hair, Good Mood</span>

      <div class="hero-title">
        <span>TRUST YOUR</span>
        <span>HAIRCUT ON DIMENSI</span>
      </div>

      <p class="hero-description">
        Your style, our passion. Experience professional
        haircuts and personalized grooming that bring out
        the best version of you.
      </p>

      <div class="hero-actions">
        <a href="#barberman" class="btn-black">Reservasi Sekarang</a>
        <a href="#tentang" class="btn-outline">Tentang Kami</a>
        <a href="#lokasi" class="btn-black">Lokasi</a>
      </div>
    </section>

    <section class="section-line"></section>

    <!-- BARBERMAN -->
    <section class="barber-section-" id="barberman">

      <div class="barber-heading">
        <div>
          <h3>Pilih Barberman Anda</h3>
          <p>Temukan barberman terbaik untuk gaya rambutmu.</p>
        </div>

        <div class="search-box">
          <i class="ri-search-line"></i>
          <input type="text" id="searchBarberman" placeholder="Cari barberman...">
        </div>
      </div>

      <div class="row g-4 justify-content-start">

        @foreach ($pegawai as $barberman)
          <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card-barberman"
            data-nama="{{ strtolower($barberman->nama_pegawai) }}">

            <div class="barber-card">

              <img
                src="{{ $barberman->foto
                    ? asset('storage/' . $barberman->foto)
                    : 'https://i.pinimg.com/originals/75/4d/35/754d3502a5b2bd7007e4eef9fc8fac25.jpg' }}"
                alt="Foto {{ $barberman->nama_pegawai }}" class="barber-photo">

              <h4>{{ $barberman->nama_pegawai }}</h4>

              <p class="barber-description">
                Profesional dalam memberikan
                pelayanan potong rambut terbaik.
              </p>

              <span class="status-badge">Aktif</span>

              <a href="{{ route('HalamanReservasi', $barberman->id_pegawai) }}" class="reserve-btn">
                Ajukan Reservasi
              </a>

            </div>

          </div>
        @endforeach

      </div>

      <p id="noBarberman" class="no-result" style="display:none">
        Barberman tidak ditemukan.
      </p>

    </section>

    <section class="section-line"></section>
    <!-- ABOUT -->
    <section class="about-section" id="tentang">
      <div class="about-text">
        <h2>Cerita di Balik<br>Gaya</h2>
        <span class="about-tag">Lebih dari Sekadar Cukur</span>
        <p class="">
          Kami percaya bahwa setiap orang memiliki karakter, gaya, dan keunikan tersendiri yang layak untuk ditampilkan.
          Di DIMENSI EVO HAIR STUDIO, kami hadir untuk membantu setiap pelanggan menemukan penampilan terbaik melalui
          potongan rambut yang berkualitas, pelayanan profesional, serta perhatian terhadap setiap detail.
        <p>
          Dengan mengutamakan kenyamanan, kebersihan, dan kepuasan pelanggan, kami berkomitmen memberikan pengalaman cukur
          yang menyenangkan dalam suasana yang nyaman. Didukung oleh barberman yang berpengalaman dan memahami berbagai
          gaya rambut, kami siap memberikan hasil potongan yang sesuai dengan keinginan dan karakter setiap pelanggan.

        </p>
        <p>
          Bagi kami, mencukur rambut bukan sekadar mengubah penampilan, tetapi juga tentang membangun rasa percaya diri
          dan memberikan pengalaman terbaik bagi setiap orang yang datang.
        </p>
      </div>

      <div id="imageCarousel" class="carousel slide carousel-custom" data-bs-ride="carousel" data-bs-interval="1500">

        <!-- Indikator -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active"></button>

          <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1"></button>

          <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2"></button>
        </div>

        <!-- Gambar -->
        <div class="carousel-inner">

          <div class="carousel-item active">
            <img src="{{ asset('assets/json/img/barbershop.png') }}" class="d-block w-100" alt="Foto 1">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('assets/json/img/barbershop.png') }}" class="d-block w-100" alt="Foto 2">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('assets/json/img/barbershop.png') }}" class="d-block w-100" alt="Foto 3">
          </div>

        </div>

        <!-- Tombol kiri -->
        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">

          <span class="carousel-control-prev-icon"></span>
        </button>

        <!-- Tombol kanan -->
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">

          <span class="carousel-control-next-icon"></span>
        </button>

      </div>
    </section>

    <section class="about-section" id="lokasi">
      <div class="about-text">
        <h2>Lokasi Dimensi Evo Hair Studio</h2>
        <p><i class="fa-solid fa-location-dot"></i>
          Jl. Pembangunan, Limbungan Baru, Rumbai, Kota Pekanbaru, Riau 28266</p>
      </div>

      <div class="about-image">
        <div class="border rounded w-fit map-border">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.627330976509!2d101.43485737447413!3d0.5606184636052962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ad1c13466c91%3A0x23e734df1ad85f0!2sDimensi.evo%20Hair%20Studio!5e0!3m2!1sen!2sid!4v1795515779656!5m2!1sen!2sid"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin" class="map-dimensi">
          </iframe>
        </div>

      </div>
    </section>
  </div>


  <script>
    const search = document.getElementById('searchBarberman');
    const cards = document.querySelectorAll('.card-barberman');
    const noResult = document.getElementById('noBarberman');

    search.addEventListener('input', function() {

      const keyword = this.value.toLowerCase();
      let jumlahDitemukan = 0;

      cards.forEach(card => {

        const nama = card.dataset.nama;

        if (nama.includes(keyword)) {

          card.style.display = '';

          requestAnimationFrame(() => {
            card.classList.remove('hide');
          });

          jumlahDitemukan++;

        } else {

          card.classList.add('hide');

          setTimeout(() => {
            if (card.classList.contains('hide')) {
              card.style.display = 'none';
            }
          }, 300);

        }

      });

      noResult.style.display = jumlahDitemukan === 0 ? 'block' : 'none';

    });
  </script>
@endsection
