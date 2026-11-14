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
@endsection

@section('page-script')
  @vite(['resources/assets/js/dashboards-analytics.js'])

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modalBayar = document.getElementById('modalBayar');
      const inputUang = document.getElementById('inputUangBayar');
      const inputTotal = document.getElementById('inputTotalBayar');
      const displayTotal = document.getElementById('displayTotalBayar');
      const displayKembalian = document.getElementById('displayKembalian');
      const inputKembalian = document.getElementById('inputKembalian');
      const peringatanKurang = document.getElementById('peringatanKurang');
      const btnSimpan = document.getElementById('btnSimpanBayar');

      // Format angka ke ribuan (contoh: 45.000)
      function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
      }

      // Saat modal terbuka, isi data dari tombol yang diklik
      modalBayar.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const antrian = button.getAttribute('data-antrian');
        const total = parseInt(button.getAttribute('data-total')) || 0;

        document.getElementById('inputReservasiId').value = id;
        document.getElementById('modalAntrian').textContent = antrian;
        document.getElementById('inputNamaPelanggan').value = nama;

        inputTotal.value = total;
        displayTotal.value = formatRupiah(total);

        // Reset input uang & kembalian setiap modal dibuka
        inputUang.value = '';
        displayKembalian.value = '0';
        inputKembalian.value = 0;
        peringatanKurang.classList.add('d-none');
        btnSimpan.disabled = true;

        // Otomatis fokus ke input uang
        setTimeout(() => inputUang.focus(), 500);
      });

      // Hitung kembalian secara real-time saat mengetik uang
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
          displayKembalian.classList.remove('text-success');
          displayKembalian.classList.add('text-danger');
          inputKembalian.value = 0;
          peringatanKurang.classList.remove('d-none');
          btnSimpan.disabled = true; // Kunci tombol simpan jika uang kurang
        }
      });
    });
  </script>
@endsection

@section('content')
  <div class="row gy-6">

    <!-- 1. Penghasilan Hari Ini -->
    <div class="col-md-12 col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="card-title mb-0">Penghasilan Hari Ini</h5>
            <div class="avatar">
              <div class="avatar-initial bg-label-success rounded shadow-xs">
                <i class="ri-money-dollar-circle-line ri-24px"></i>
              </div>
            </div>
          </div>
          <p class="text-muted mb-3">Total pendapatan masuk hari ini</p>
          <h3 class="text-primary mb-1">Rp {{ number_format($penghasilanHariIni ?? 450000, 0, ',', '.') }}</h3>
          <small class="text-muted">Update otomatis dari transaksi selesai</small>
        </div>
      </div>
    </div>

    <!-- Ringkasan Singkat Hari Ini (Opsional agar sejajar rapi di baris atas) -->
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
                  <h5 class="mb-0">{{ $totalOnline ?? 2 }}</h5>
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
                  <h5 class="mb-0">{{ $totalWalkIn ?? 2 }}</h5>
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
                  <h5 class="mb-0">{{ $totalSelesai ?? 5 }}</h5>
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
          <h5 class="card-title mb-0">Table Reservasi Online</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-sm align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="table-light">
              <tr>
                <th class="px-3">Pelanggan</th>
                <th class="px-2">Nomor HP</th>
                <th class="px-2">Paket</th>
                <th class="px-2">Antrian</th>
                <th class="px-2">Jadwal</th>
                <th class="px-2">Total Bayar</th>
                <th class="px-3 text-center">Input Pembayaran</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <!-- Baris 1: Budi Santoso -->
              <tr>
                <td class="px-3">
                  <div class="fw-semibold text-heading">Budi Santoso</div>
                  <small class="text-muted">budi@gmail.com</small>
                </td>
                <td class="px-2">081234567890</td>
                <td class="px-2"><span class="badge bg-label-primary">Paket Basic</span></td>
                <td class="px-2"><span class="badge bg-label-dark">A-01</span></td>
                <td class="px-2">
                  <div>Mulai: 10:00</div>
                  <small class="text-muted">Selesai: 10:45</small>
                </td>
                <td class="px-2"><span class="badge bg-label-info">Rp. 45.000</span></td>
                <td class="px-3">
                  <div class="d-flex justify-content-center gap-1">
                    <!-- Kirim data Budi Santoso -->
                    <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal"
                      data-bs-target="#modalBayar" onclick="bukaModalBayar('A-01', 'Budi Santoso', 45000)">
                      Bayar
                    </button>
                    <form action="#" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-danger">Batal</button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Baris 2: Andi Wijaya -->
              <tr>
                <td class="px-3">
                  <div class="fw-semibold text-heading">Andi Wijaya</div>
                  <small class="text-muted">andi.w@gmail.com</small>
                </td>
                <td class="px-2">089876543210</td>
                <td class="px-2"><span class="badge bg-label-primary">Paket Premium</span></td>
                <td class="px-2"><span class="badge bg-label-dark">A-02</span></td>
                <td class="px-2">
                  <div>Mulai: 11:00</div>
                  <small class="text-muted">Selesai: 11:45</small>
                </td>
                <td class="px-2"><span class="badge bg-label-info">Rp. 75.000</span></td>
                <td class="px-3">
                  <div class="d-flex justify-content-center gap-1">
                    <!-- Kirim data Andi Wijaya -->
                    <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal"
                      data-bs-target="#modalBayar" onclick="bukaModalBayar('A-02', 'Andi Wijaya', 75000)">
                      Bayar
                    </button>
                    <form action="#" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-danger">Batal</button>
                    </form>
                  </div>
                </td>
              </tr>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 3. Table Reservasi Walk-In -->
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Table Reservasi Walk-In</h5>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInputWalkIn">
            <i class="ri-add-line me-1"></i> Input Reservasi
          </button>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-sm align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="table-light">
              <tr>
                <th class="px-2">Pelanggan</th>
                <th class="px-2">Paket Layanan</th>
                <th class="px-2">Nomor Antrian</th>
                <th class="px-2">Total Bayar</th>
                <th class="px-2">Input Pembayaran</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <tr>
                <td class="px-3"><strong>Reza Rahadian</strong></td>
                <td><span class="badge bg-label-primary">Paket Basic</span></td>
                <td><span class="badge bg-label-dark">W-01</span></td>
                <td class="px-2"><span class="badge bg-label-info">Rp. 45.000</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                    data-bs-target="#modalBayar" onclick="bukaModalBayar('W-01', 'Reza Rahadian', 45000)">Bayar</button>
                  <button type="submit" class="btn btn-sm btn-danger">Batal</button>
                </td>
              </tr>
              <tr>
                <td class="px-3"><strong>Dimas Anggara</strong></td>
                <td><span class="badge bg-label-primary">Paket Basic</span></td>
                <td><span class="badge bg-label-dark">W-02</span></td>
                <td class="px-2"><span class="badge bg-label-info">Rp. 45.000</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                    data-bs-target="#modalBayar" onclick="bukaModalBayar('W-02', 'Dimas Anggara', 45000)">Bayar</button>
                  <button type="submit" class="btn btn-sm btn-danger">Batal</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Form Input Reservasi Walk-In -->
    <div class="modal fade" id="modalInputWalkIn" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Input Reservasi Walk-In</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" method="POST">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan"
                  required>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Paket Layanan</label>
                  <select name="paket_layanan" class="form-select" required>
                    <option value="Paket Basic">Paket Basic</option>
                    <option value="Paket Premium">Paket Premium</option>
                    <option value="Cukur + Cuci">Cukur + Cuci</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nomor Antrian</label>
                  <input type="text" name="nomor_antrian" class="form-control" placeholder="Contoh: W-03" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan Reservasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Input Pembayaran (<span id="modalAntrian">-</span>)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="#" method="POST">
            @csrf
            <div class="modal-body">
              <!-- Nama Pelanggan -->
              <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" id="namaPelanggan" class="form-control" readonly>
              </div>

              <!-- Total Bayar -->
              <div class="mb-3">
                <label class="form-label">Total Bayar</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" id="totalBayar" class="form-control fw-bold" readonly>
                </div>
              </div>

              <!-- Uang Diterima -->
              <div class="mb-3">
                <label class="form-label">Uang Diterima</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" id="uangDiterima" oninput="hitungKembalian()" class="form-control"
                    placeholder="Masukkan nominal uang" required>
                </div>
              </div>

              <!-- Kembalian -->
              <div class="mb-2">
                <label class="form-label">Kembalian</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="text" id="kembalian" class="form-control fw-bold text-success" value="0"
                    readonly>
                </div>
                <small id="pesanKurang" class="text-danger d-none">Uang pembayaran masih kurang!</small>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" id="btnKonfirmasi" class="btn btn-success" disabled>Konfirmasi Bayar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // 1. Fungsi mengisi data ke modal sesuai tombol baris yang diklik
      function bukaModalBayar(antrian, nama, total) {
        document.getElementById('modalAntrian').textContent = antrian;
        document.getElementById('namaPelanggan').value = nama;
        document.getElementById('totalBayar').value = total;

        // Reset kolom input uang & kembalian setiap kali pindah pelanggan
        document.getElementById('uangDiterima').value = '';
        document.getElementById('kembalian').value = '0';
        document.getElementById('pesanKurang').classList.add('d-none');
        document.getElementById('btnKonfirmasi').disabled = true;
      }

      // 2. Fungsi menghitung kembalian saat mengetik uang
      function hitungKembalian() {
        const total = parseInt(document.getElementById('totalBayar').value) || 0;
        const uang = parseInt(document.getElementById('uangDiterima').value) || 0;
        const fieldKembalian = document.getElementById('kembalian');
        const pesanKurang = document.getElementById('pesanKurang');
        const btnKonfirmasi = document.getElementById('btnKonfirmasi');

        if (uang >= total && total > 0) {
          const hasil = uang - total;
          fieldKembalian.value = new Intl.NumberFormat('id-ID').format(hasil);
          pesanKurang.classList.add('d-none');
          btnKonfirmasi.disabled = false;
        } else {
          fieldKembalian.value = '0';
          if (uang > 0) {
            pesanKurang.classList.remove('d-none');
          } else {
            pesanKurang.classList.add('d-none');
          }
          btnKonfirmasi.disabled = true;
        }
      }
    </script>

  </div>
@endsection
