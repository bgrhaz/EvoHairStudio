@extends('layouts.pelanggan-layout.app')

@section('title', 'Kontak')

@section('content')

  <div class="row gy-6">

    {{-- Header Halaman --}}
    <div class="col-12">
      <div class="contact-heading">
        <h4>Hubungi Kami</h4>
        <p>
          Ada pertanyaan, kendala, atau membutuhkan bantuan?
          Silakan hubungi kami melalui formulir berikut.
        </p>
      </div>
    </div>

    {{-- Informasi Kontak --}}
    <div class="col-12">
      <div class="row g-4">

        <div class="col-md-4">
          <div class="contact-info-card">
            <div class="contact-icon">
              <i class="ti ti-brand-whatsapp"></i>
            </div>
            <h6>WhatsApp</h6>
            <p>Hubungi admin secara langsung.</p>
            <a href="https://wa.me/6281234567890" target="_blank">
              Hubungi Sekarang
              <i class="ti ti-arrow-up-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-info-card">
            <div class="contact-icon">
              <i class="ti ti-mail"></i>
            </div>
            <h6>Email</h6>
            <p>Kirim pertanyaan melalui email.</p>
            <a href="mailto:admin@example.com">
              Kirim Email
              <i class="ti ti-arrow-up-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-info-card">
            <div class="contact-icon">
              <i class="ti ti-clock"></i>
            </div>
            <h6>Jam Operasional</h6>
            <p>Senin - Jumat</p>
            <span class="contact-detail">
              08.00 - 17.00 WIB
            </span>
          </div>
        </div>

      </div>
    </div>

    {{-- Form Kontak dan Bantuan --}}
    <div class="col-lg-8">
      <div class="card contact-main-card">

        <div class="card-header">
          <div>
            <h5 class="mb-1">Kirim Pesan</h5>
            <p class="text-muted mb-0">
              Sampaikan pertanyaan atau keluhan Anda.
            </p>
          </div>
        </div>

        <div class="card-body">

          <form action="{{ route('KirimPesan') }}" method="POST">
            @csrf
            <div class="row g-4">

              <div class="col-md-6">
                <label class="form-label">
                  Nama Lengkap
                </label>
                <input type="text" name="nama_pengirim" class="form-control" placeholder="Masukkan nama lengkap"
                  required>
              </div>

              <div class="col-12">
                <label class="form-label">
                  Subjek Pesan
                </label>
                <input type="text" name="subjek" class="form-control" placeholder="Masukkan subjek pesan" required>
              </div>

              <div class="col-12">
                <label class="form-label">
                  Isi Pesan
                </label>
                <textarea name="pesan" class="form-control" rows="5" placeholder="Tuliskan pertanyaan atau keluhan Anda..."
                  required></textarea>
              </div>

            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-send-message">
                <i class="ti ti-send me-1"></i>
                Kirim Pesan
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

    {{-- FAQ --}}
    <div class="col-lg-4">
      <div class="card contact-main-card faq-card">

        <div class="card-header">
          <div>
            <h5 class="mb-1">Butuh Bantuan?</h5>
            <p class="text-muted mb-0">
              Pertanyaan yang sering diajukan.
            </p>
          </div>
        </div>

        <div class="card-body">

          <div class="accordion" id="contactFAQ">

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faqOne">
                  Bagaimana cara mengubah username?
                </button>
              </h2>
              <div id="faqOne" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                <div class="accordion-body">
                  Anda dapat mengubah username melalui
                  menu Pengaturan Akun.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faqTwo">
                  Bagaimana cara mengganti password?
                </button>
              </h2>
              <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                <div class="accordion-body">
                  Buka menu Pengaturan Akun, kemudian
                  isi bagian Ganti Kata Sandi.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faqThree">
                  Bagaimana menghubungi admin?
                </button>
              </h2>
              <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                <div class="accordion-body">
                  Anda dapat menghubungi admin melalui
                  WhatsApp atau email yang tersedia
                  pada halaman ini.
                </div>
              </div>
            </div>

          </div>

          <div class="contact-help-box mt-4">
            <i class="ti ti-headset"></i>
            <h6>Masih membutuhkan bantuan?</h6>
            <p>
              Tim kami siap membantu Anda menyelesaikan
              kendala yang dialami.
            </p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-help">
              Hubungi Admin
            </a>
          </div>

        </div>
      </div>
    </div>

  </div>

@endsection
