@extends('layouts/barberman-layout/app')
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

      const modalBayar = document.getElementById('modalBayar');

      const inputNama = document.getElementById('inputNamaPelanggan');
      const inputTotal = document.getElementById('inputTotalBayar');
      const inputUang = document.getElementById('inputUangBayar');

      const displayKembalian = document.getElementById('displayKembalian');
      const inputKembalian = document.getElementById('inputKembalian');

      const peringatanKurang = document.getElementById('peringatanKurang');
      const btnSimpan = document.getElementById('btnSimpanBayar');

      function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
      }

      // Mengambil data dari tombol yang diklik
      modalBayar.addEventListener('show.bs.modal', function(event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const id_reservasi = button.getAttribute('data-id-reservasi');
        const nama = button.getAttribute('data-nama');
        const antrian = button.getAttribute('data-antrian');
        const total = parseInt(button.getAttribute('data-total')) || 0;
        const id_pegawai = button.getAttribute('data-id-pegawai');
        const id_layanan = button.getAttribute('data-id-kategori');

        document.getElementById('inputReservasiId').value = id_reservasi;
        document.getElementById('modalAntrian').textContent = antrian;
        document.getElementById('inputIdPegawai').value = id_pegawai;
        document.getElementById('inputKodeReservasi').value = antrian;
        document.getElementById('inputIdLayanan').value = id_layanan;

        inputNama.value = nama;
        inputTotal.value = total;

        // Reset pembayaran
        inputUang.value = '';
        displayKembalian.value = '0';
        inputKembalian.value = 0;

        peringatanKurang.classList.add('d-none');
        btnSimpan.disabled = true;
      });

      // Menghitung kembalian
      inputUang.addEventListener('input', function() {

        const total = parseInt(inputTotal.value) || 0;
        const uang = parseInt(this.value) || 0;

        const kembalian = uang - total;

        if (uang >= total && total > 0) {

          displayKembalian.value = formatRupiah(kembalian);

          displayKembalian.classList.remove('text-danger');
          displayKembalian.classList.add('text-success');

          inputKembalian.value = kembalian;

          peringatanKurang.classList.add('d-none');
          btnSimpan.disabled = false;

        } else {

          displayKembalian.value = '0';

          inputKembalian.value = 0;

          displayKembalian.classList.remove('text-success');
          displayKembalian.classList.add('text-danger');

          peringatanKurang.classList.remove('d-none');
          btnSimpan.disabled = true;
        }
      });

    });
  </script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const tanggalInput = document.getElementById('tanggal_reservasi');
      const barbermanDipilih = document.getElementById('barbermanDipilih');

      const urlTemplate = @json(route('admin.cekJadwal', [
              'id' => '__ID__',
          ]));

      async function cekJadwal() {

        const idPegawai = barbermanDipilih.value;
        const tanggal = tanggalInput.value;

        if (!idPegawai || !tanggal) return;

        const url = urlTemplate.replace(
          '__ID__',
          encodeURIComponent(idPegawai)
        );

        try {

          const response = await fetch(
            url + '?tanggal_reservasi=' + encodeURIComponent(tanggal)
          );

          if (!response.ok) {
            throw new Error('Gagal mengambil jadwal');
          }

          const data = await response.json();

          console.log('Data jadwal:', data);

          // Cocokkan berdasarkan id_jam
          const jadwalBarberman = new Map(
            data.map(item => [Number(item.id_jam), item])
          );

          document.querySelectorAll('.slot-jadwal').forEach(input => {

            const idJam = Number(input.dataset.jam);

            const label = document.getElementById(
              'label-' + input.id
            );

            const jadwal = jadwalBarberman.get(idJam);

            // Jika barberman tidak memiliki jadwal tersebut
            if (!jadwal) {

              input.disabled = true;
              input.checked = false;

              label.classList.remove(
                'btn-outline-primary',
                'btn-outline-danger'
              );

              label.classList.add('btn-outline-secondary');

              return;
            }

            // Masukkan id_jadwal ke value radio button
            input.value = jadwal.id_jadwal;

            const sudahDipesan = jadwal.terpakai;

            input.disabled = sudahDipesan;

            if (sudahDipesan) {

              input.checked = false;

              label.classList.remove('btn-outline-primary');
              label.classList.add('btn-outline-danger');

            } else {

              label.classList.remove(
                'btn-outline-danger',
                'btn-outline-secondary'
              );

              label.classList.add('btn-outline-primary');

            }

          });

        } catch (error) {

          console.error('Gagal mengecek jadwal:', error);

        }
      }

      // Saat halaman pertama dibuka
      cekJadwal();

      // Saat barberman diganti
      barbermanDipilih.addEventListener('change', cekJadwal);

      // Saat tanggal diganti
      tanggalInput.addEventListener('change', cekJadwal);

      // Saat modal dibuka
      document.getElementById('modalInputWalkIn')
        .addEventListener('shown.bs.modal', cekJadwal);

    });
  </script>

@endsection

@section('content')
  <div class="row gy-6">
    <!-- Ringkasan Singkat Hari Ini-->
    <div class="col-lg-8">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="card-title mb-1">Ringkasan Antrian Hari Ini</h5>
          <p class="card-subtitle mb-0">Status reservasi pelanggan barbershop</p>
        </div>
        <div class="card-body pt-lg-4">
          <div class="row g-4">
            <div class="col-sm-4">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-label-primary rounded shadow-xs">
                    <i class="ri-calendar-check-line ri-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <p class="mb-0">Reservasi Online</p>
                  <h5 class="mb-0">{{ count($reservasiOnline) }}</h5>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-label-warning rounded shadow-xs">
                    <i class="ri-walk-line ri-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <p class="mb-0">Walk-In</p>
                  <h5 class="mb-0">{{ count($reservasiOffline) }}</h5>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-label-info rounded shadow-xs">
                    <i class="ri-scissors-2-line ri-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <p class="mb-0">Selesai Dilayani</p>
                  <h5 class="mb-0">{{ count($penghasilan) }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. Table Reservasi Online -->
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <h5 class="card-title mb-0">Jadwal Reservasi Pelanggan Online</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-sm align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="table-light">
              <tr>
                <th class="px-3">Pelanggan</th>
                <th class="px-2">Paket</th>
                <th class="px-2">Antrian</th>
                <th class="px-2">Jadwal</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($reservasiOnline as $pelanggan)
                <tr>
                  <td class="px-3">
                    <div class="fw-semibold text-heading">{{ $pelanggan->nama_pelanggan }}</div>
                    <small class="text-muted">{{ $pelanggan->email }}</small><br>
                    <small class="text-muted">{{ $pelanggan->nomor_hp }}</small>
                  </td>
                  <td class="px-2"><span class="badge bg-label-primary">{{ $pelanggan->nama_layanan }}</span></td>
                  <td class="px-2"><span class="badge bg-label-dark">{{ $pelanggan->kode_reservasi }}</span></td>
                  <td class="px-2">
                    <div>Mulai: {{ $pelanggan->jam_mulai }}</div>
                    <small class="text-muted">Selesai: {{ $pelanggan->jam_selesai }}</small>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 3. Table Reservasi Walk-In -->
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Jadwal Reservasi Pelanggan Walk-In</h5>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-sm align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="table-light">
              <tr>
                <th class="px-3">Pelanggan</th>
                <th class="px-2">Paket</th>
                <th class="px-2">Antrian</th>
                <th class="px-2">Jadwal</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($reservasiOffline as $pelanggan)
                <tr>
                  <td class="px-3">
                    <div class="fw-semibold text-heading">{{ $pelanggan->nama_pelanggan }}</div>
                    <small class="text-muted">{{ $pelanggan->email }}</small><br>
                    <small class="text-muted">{{ $pelanggan->nomor_hp }}</small>
                  </td>
                  <td class="px-2"><span class="badge bg-label-primary">{{ $pelanggan->nama_layanan }}</span></td>
                  <td class="px-2"><span class="badge bg-label-dark">{{ $pelanggan->kode_reservasi }}</span></td>
                  <td class="px-2">
                    <div>Mulai: {{ $pelanggan->jam_mulai }}</div>
                    <small class="text-muted">Selesai: {{ $pelanggan->jam_selesai }}</small>
                  </td>
                </tr>
              @endforeach


            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- <!-- Modal Form Input Reservasi Walk-In -->
    <div class="modal fade" id="modalInputWalkIn" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Ajukan Reservasi Walk-In</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form action="{{ route('admin.AjukanReservasiOffline') }}" method="POST">
            @csrf

            <div class="modal-body">

              <!-- Nama Pelanggan -->
              <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan"
                  required>
              </div>

              <!-- Layanan -->
              <div class="mb-3">
                <label class="form-label">Pilih Layanan</label>
                <select name="id_layanan" id="layananDipilih" class="form-select" required>

                  <option value="">-- Pilih Layanan --</option>

                  @foreach ($layanan as $item)
                    <option value="{{ $item->id_layanan }}">
                      {{ $item->nama_layanan }}
                    </option>
                  @endforeach

                </select>
              </div>

              <!-- Barberman -->
              <div class="mb-3">
                <label class="form-label">Pilih Barberman</label>
                <select name="id_pegawai" id="barbermanDipilih" class="form-select" required>

                  @foreach ($barberman as $pegawai)
                    <option value="{{ $pegawai->id_pegawai }}" @selected($loop->first)>
                      {{ $pegawai->nama_pegawai }}
                    </option>
                  @endforeach

                </select>
              </div>

              <!-- Tanggal Reservasi -->
              <div class="mb-3">
                <label class="form-label">Tanggal Reservasi</label>
                <input type="date" name="tanggal_reservasi" id="tanggal_reservasi" class="form-control"
                  value="{{ date('Y-m-d') }}" min="{{ today()->format('Y-m-d') }}" required>
              </div>

              <!-- Nomor Antrian -->
              <!-- Jam Tersedia -->
              <div class="mb-2">
                <label class="form-label">Pilih Jam Tersedia</label>
                <div class="row g-2">
                  @foreach ($jadwal as $jam)
                    <div class="col-4 col-sm-3">
                      <input type="radio" class="btn-check slot-jadwal" name="id_jadwal"
                        id="jadwal-{{ $loop->index }}" value="" data-jam="{{ $jam->id_jam }}" required>

                      <label class="btn btn-outline-primary w-100" id="label-jadwal-{{ $loop->index }}"
                        for="jadwal-{{ $loop->index }}">
                        {{ $jam->jam }}
                      </label>


                    </div>
                  @endforeach

                </div>

                <small class="text-muted">
                  Jam berwarna merah berarti sudah dipesan.
                </small>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>

              <button type="submit" class="btn btn-primary">
                Ajukan Reservasi
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>


    <!-- Modal Pembayaran -->
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">
              Input Pembayaran (<span id="modalAntrian">-</span>)
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form action="{{ route('admin.transaksi') }}" method="POST">
            @csrf

            <input type="hidden" name="id_reservasi" id="inputReservasiId">
            <input type="hidden" name="id_pegawai" id="inputIdPegawai">
            <input type="hidden" name="kode_reservasi" id="inputKodeReservasi">
            <input type="hidden" name="id_layanan" id="inputIdLayanan">

            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="inputNamaPelanggan" class="form-control" readonly>
              </div>

              <div class="mb-3">
                <label class="form-label">Total Bayar</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" name="total_bayar" id="inputTotalBayar" class="form-control fw-bold" readonly>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Uang Diterima</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" name="uang_diterima" id="inputUangBayar" class="form-control"
                    placeholder="Masukkan nominal uang" required>
                </div>
              </div>

              <div class="mb-2">
                <label class="form-label">Kembalian</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="text" id="displayKembalian" class="form-control fw-bold text-success" value="0"
                    readonly>
                </div>

                <input type="hidden" name="kembalian" id="inputKembalian">

                <small id="peringatanKurang" class="text-danger d-none">
                  Uang pembayaran masih kurang!
                </small>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>

              <button type="submit" id="btnSimpanBayar" class="btn btn-success" disabled>
                Konfirmasi Bayar
              </button>
            </div>

          </form>
        </div>
      </div>
    </div> --}}
  </div>




@endsection
