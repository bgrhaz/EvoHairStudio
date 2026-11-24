@extends('layouts.landing-layout.app')

@section('title', 'DIMENSI EVO HAIR STUDIO')

@section('content')

  <div class="user-home">

    <!-- NAVBAR -->


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
        <a href="#barberman" class="btn-black">Book Now</a>
        <a href="#tentang" class="btn-outline">Profile</a>
      </div>

      <!-- STATISTIK -->
      <div class="hero-stats">
        <div>
          <h3>5.0</h3>
          <span>Rating</span>
        </div>

        <div>
          <h3>500+</h3>
          <span>Customers</span>
        </div>

        <div>
          <h3>Expert</h3>
          <span>Barber</span>
        </div>
      </div>

    </section>

    <!-- ABOUT -->
    <section class="about-section" id="tentang">
      <div class="about-text">
        <h2>Cerita<br>di Balik<br>Gaya</h2>
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

    <!-- BARBERMAN -->
    <section class="barber-section" id="barberman">

      <div class="barber-heading">
        <div>
          <span class="section-label">PROFESSIONAL TIM KAMI</span>
          <h2>Temukan Barbermanmu</h2>
          <p>Mereka adalah pilihan terbaik untuk gaya rambutmu.</p>
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

              <a href="{{ route('login') }}" class="reserve-btn">
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

    <!-- FOOTER -->
    <footer class="landing-footer" id="kontak">
      <div>
        <strong>DIMENSI EVO HAIR STUDIO</strong>
        <p>Look good. Feel confident.</p>
      </div>

      <p>© 2026 DIMENSI EVO HAIR STUDIO</p>
    </footer>

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
