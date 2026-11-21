@extends('layouts/admin-layout/app')
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
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h5 class="card-title mb-1">Riwayat Transaksi Admin</h5>
            <small class="text-muted">Daftar transaksi yang diproses oleh admin</small>
          </div>

          <span class="badge bg-label-primary">
            {{ count($dataAdmin) }} Transaksi
          </span>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="px-4">Pelanggan</th>
                <th>Admin</th>
                <th>Nomor Antrian</th>
                <th>Paket Layanan</th>
                <th>Total</th>
                <th>Uang Diterima</th>
                <th>Kembalian</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($dataAdmin as $item)
                <tr>
                  {{-- Nama Pelanggan --}}
                  <td class="px-4">
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-sm me-3">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                          {{ strtoupper(substr($item->nama_pelanggan ?? '-', 0, 1)) }}
                        </span>
                      </div>

                      <div>
                        <h6 class="mb-0 text-heading">
                          {{ $item->nama_pelanggan ?? '-' }}
                        </h6>
                        <small class="text-muted">Pelanggan</small>
                      </div>
                    </div>
                  </td>

                  {{-- Nama Admin --}}
                  <td>
                    <div class="d-flex align-items-center">
                      <i class="ri-user-settings-line ri-20px text-primary me-2"></i>
                      <span>{{ $item->nama_admin ?? '-' }}</span>
                    </div>
                  </td>

                  {{-- Nomor Antrian --}}
                  <td>
                    <span class="badge bg-label-dark">
                      {{ $item->nomor_antrian ?? '-' }}
                    </span>
                  </td>

                  {{-- Paket Layanan --}}
                  <td>
                    <span class="badge bg-label-primary">
                      {{ $item->nama_layanan ?? '-' }}
                    </span>
                  </td>

                  {{-- Total --}}
                  <td class="fw-semibold text-heading">
                    Rp {{ number_format((float) ($item->total_bayar ?? 0), 0, ',', '.') }}
                  </td>

                  {{-- Uang Diterima --}}
                  <td class="text-success fw-semibold">
                    Rp {{ number_format((float) ($item->uang_dibayar ?? 0), 0, ',', '.') }}
                  </td>

                  {{-- Kembalian --}}
                  <td class="text-primary fw-semibold">
                    Rp {{ number_format((float) ($item->kembalian ?? 0), 0, ',', '.') }}
                  </td>
                </tr>

              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <i class="ri-file-list-3-line ri-3x text-muted d-block mb-2"></i>
                    <h6 class="mb-1">Belum Ada Transaksi</h6>
                    <small class="text-muted">
                      Data transaksi admin belum tersedia.
                    </small>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
@endsection
