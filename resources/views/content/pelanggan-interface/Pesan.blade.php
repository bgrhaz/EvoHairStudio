@extends('layouts.pelanggan-layout.app')



@section('content')
  <div class="inbox-page">

    <div class="inbox-layout">

      <!-- DAFTAR PESAN -->
      <div class="inbox-card">
        <div class="inbox-card-header">
          <h4>Daftar Pesan</h4>
          <span>3 Pesan</span>
        </div>

        <div class="table-responsive">
          <table class="inbox-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Pengirim</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Detail</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($Pesan as $pesan)
                <tr>
                  <td>1</td>
                  <td>{{ $pesan->nama_pengirim }}</td>
                  <td>{{ $pesan->subjek }}</td>
                  <td>
                    @if ($pesan->dibaca == 0)
                      <span class="badge-status unread">
                        Belum Dibaca
                      </span>
                    @else
                      <span class="badge-status read">
                        Sudah Dibaca
                      </span>
                    @endif

                  </td>
                  <td>
                    <button class="btn-read" data-bs-toggle="modal" data-bs-target="#messageModal"
                      data-pengirim="{{ $pesan->nama_pengirim }}" data-subjek="{{ $pesan->subjek }}"
                      data-tanggal="{{ $pesan->tanggal }}" data-pesan="{{ $pesan->pesan }}">
                      Baca
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- KARTU BANTUAN -->
      <div class="help-card">
        <div class="help-content">
          <div class="help-icon">✉</div>

          <h4>Membutuhkan bantuan?</h4>

          <p>
            Tim kami siap membantu Anda menyelesaikan
            kendala atau menjawab pertanyaan yang dialami.
          </p>

          <a href="{{ url('/kontak') }}" class="btn-help">
            Hubungi Admin
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- MODAL BACA PESAN -->
  <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="messageModalLabel">
            Detail Pesan
          </h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>


        <div class="modal-body">

          <div class="message-info">

            <div class="mb-3">
              <label class="form-label fw-bold">Nama Pengirim</label>
              <div class="form-control bg-light" id="namaPengirim">
                Admin DIMENSI EVO
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Subjek</label>
              <div class="form-control bg-light" id="subjekPesan">
                Reservasi Berhasil
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Tanggal</label>
              <div class="form-control bg-light" id="tanggalPesan">
                25 November 2026
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Isi Pesan</label>
              <div class="form-control bg-light message-text" id="isiPesan">
                Selamat! Reservasi Anda berhasil dikonfirmasi.
                Terima kasih telah memilih DIMENSI EVO HAIR STUDIO.
                Kami tunggu kedatangan Anda!
              </div>
            </div>

          </div>

        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Tutup
          </button>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const pengirim = document.getElementById('namaPengirim');
      const subjek = document.getElementById('subjekPesan');
      const tanggal = document.getElementById('tanggalPesan');
      const pesan = document.getElementById('isiPesan');

      const modal = document.getElementById('messageModal');

      modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const dataPengirim = button.getAttribute('data-pengirim');
        const dataSubjek = button.getAttribute('data-subjek');
        const dataTanggal = button.getAttribute('data-tanggal');
        const dataPesan = button.getAttribute('data-pesan');

        pengirim.textContent = dataPengirim;
        subjek.textContent = dataSubjek;
        tanggal.textContent = dataTanggal;
        pesan.textContent = dataPesan;

      });
    });
  </script>
@endsection
