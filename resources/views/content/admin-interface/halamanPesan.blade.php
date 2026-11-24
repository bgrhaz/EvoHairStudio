@extends('layouts/admin-layout/app')
@section('title', 'Dashboard - Admin')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/dashboards-analytics.js'])

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modalBacaPesan = document.getElementById('modalBacaPesan');
      const namaPengirim = document.getElementById('namaPengirim');
      const emailPengirim = document.getElementById('emailPengirim');
      const tanggalPesan = document.getElementById('tanggalPesan');
      const subjekPesan = document.getElementById('subjekPesan');
      const pesanPengirim = document.getElementById('isiPesan');
      const notif = document.getElementById('notif');

      modalBacaPesan.addEventListener('show.bs.modal', function(event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const url = button.getAttribute('data-url');
        const nama = button.getAttribute('data-nama-pengirim');
        const email = button.getAttribute('data-email-pengirim');
        const tanggal = button.getAttribute('data-tanggal-pesan');
        const subjek = button.getAttribute('data-subjek-pesan');
        const pesan = button.getAttribute('data-isi-pesan');



        fetch(url, {
            method: 'PATCH',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              namaPengirim.textContent = nama;
              emailPengirim.textContent = email;
              tanggalPesan.innerHTML = `<i class="ti ti-calendar"></i> ${tanggal}`;
              subjekPesan.textContent = subjek;
              pesanPengirim.textContent = pesan;
              let notifAwal = Number(notif.innerText);
              if (notifAwal > 0) {
                let notifAkhir = notifAwal - 1;
                if (notifAkhir == 0) {
                  notif.classList.remove('notif');
                  notif.innerHTML = '';
                } else {
                  notif.innerHTML = notifAkhir;
                }
              }

              const badge = document.getElementById(`badge-${id}`);

              if (badge && badge.classList.contains('bg-danger')) {
                badge.classList.replace('bg-danger', 'bg-success');
                badge.textContent = 'Sudah Dibaca';
              }
            }
          })
          .catch(error => {
            console.error('Terjadi kesalahan:', error);
          });
      });

    })
  </script>

@endsection


@section('content')

  <div class="row gy-4">

    {{-- Header --}}
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
          <h4 style="color: #e9c44d; font-weight: 700;">
            Pesan Masuk
          </h4>
          <p class="mb-0" style="color: #999;">
            Daftar pesan yang dikirim oleh pelanggan.
          </p>
        </div>

        <div style="color: #e9c44d;">
          <i class="ti ti-mail me-1"></i>
          {{-- {{ $pesan->total() }} Pesan --}}
        </div>
      </div>
    </div>

    {{-- Daftar Pesan --}}
    <div class="col-12">
      <div class="card" style="background: #171717; border: 1px solid #302a1d;">

        <div class="card-header" style="border-bottom: 1px solid #302a1d;">
          <h5 class="mb-0" style="color: #e9c44d;">
            Daftar Pesan Pelanggan
          </h5>
        </div>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr style="color: #e9c44d;">
                <th>No</th>
                <th>Nama Pengirim</th>
                <th>Email</th>
                <th>Subjek</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($DataPesan as $pesan)
                <tr style="color: #ddd;" id="pesan-{{ $pesan->id_pesan }}">
                  <td>1</td>
                  <td>{{ $pesan->nama_pengirim }}</td>
                  <td>{{ $pesan->email }}</td>
                  <td>{{ $pesan->subjek }}</td>
                  <td>{{ $pesan->tanggal }}</td>
                  <td>
                    @if ($pesan->dibaca == 0)
                      <span class="badge bg-danger" id="badge-{{ $pesan->id_pesan }}">
                        Belum Dibaca
                      </span>
                    @else
                      <span class="badge bg-success" id="badge-{{ $pesan->id_pesan }}">
                        Sudah Dibaca
                      </span>
                    @endif

                  </td>
                  <td>

                    <button type="button" class="btn btn-sm" style="background: #d5ae32; color: #171717;"
                      data-bs-toggle="modal" data-bs-target="#modalBacaPesan"
                      data-nama-pengirim="{{ $pesan->nama_pengirim }}" data-email-pengirim="{{ $pesan->email }}"
                      data-tanggal-pesan="{{ $pesan->tanggal }}" data-subjek-pesan="{{ $pesan->subjek }}"
                      data-isi-pesan="{{ $pesan->pesan }}" data-id="{{ $pesan->id_pesan }}"
                      data-url="{{ route('admin.pesan.dibaca', $pesan->id_pesan) }}">
                      <i class="ti ti-eye"></i>
                      Baca Pesan
                    </button>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="card-footer">
          {{-- {{ $pesan->links() }} --}}
        </div>

      </div>
    </div>

  </div>



  <!-- Modal Baca Pesan -->
  <div class="modal fade" id="modalBacaPesan" tabindex="-1" aria-labelledby="modalBacaPesanLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content modal-pesan">

        <!-- Header -->
        <div class="modal-header modal-pesan-header">
          <div>
            <div class="d-flex align-items-center gap-2 mb-1">
              <i class="ti ti-mail-opened" style="color: #e9c44d; font-size: 23px;"></i>
              <h5 class="modal-title mb-0" id="modalBacaPesanLabel">
                Detail Pesan
              </h5>
            </div>
            <small>Informasi pesan dari pelanggan</small>
          </div>

          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Body -->
        <div class="modal-body modal-pesan-body">

          <!-- Informasi Pengirim -->
          <div class="pesan-pengirim">
            <div class="pesan-avatar">
              R
            </div>

            <div class="pesan-identitas">
              <h6 id="namaPengirim"></h6>
              <span id="emailPengirim">rendi@gmail.com</span>
            </div>

            <div class="pesan-waktu" id="tanggalPesan"></div>

          </div>

          <hr class="pesan-divider">

          <!-- Subjek -->
          <div class="pesan-subjek">
            <label>Subjek Pesan</label>
            <h6 id="subjekPesan">Permintaan Informasi Layanan</h6>
          </div>

          <!-- Isi Pesan -->
          <div class="pesan-isi">
            <label>Isi Pesan</label>

            <div class="pesan-content">
              <p id="isiPesan">
                Selamat siang Admin BarberShop EVO.

                Saya ingin menanyakan informasi mengenai
                layanan yang tersedia di BarberShop EVO.
                Apakah saya bisa mendapatkan informasi
                mengenai jenis layanan dan harga yang
                ditawarkan?

                Terima kasih atas bantuannya. Saya menunggu
                informasi lebih lanjut dari pihak admin.
              </p>
            </div>
          </div>

        </div>

        <!-- Footer -->
        <div class="modal-footer modal-pesan-footer">

          <button type="button" class="btn btn-tutup-pesan" data-bs-dismiss="modal">
            <i class="ti ti-x me-1"></i>
            Tutup
          </button>

          <a href="mailto:rendi@gmail.com" class="btn btn-balaspesan">
            <i class="ti ti-mail me-1"></i>
            Balas Pesan
          </a>

        </div>

      </div>
    </div>
  </div>


@endsection
