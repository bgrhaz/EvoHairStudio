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
      <div class="card overflow-hidden">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Nama</th>
                <th class="text-truncate">Email</th>
                <th class="text-truncate">Role</th>
                <th class="text-truncate">Status</th>
                {{-- <th class="text-truncate">Pengaturan Jadwal</th> --}}
              </tr>
            </thead>
            <tbody>
              @forelse ($dataAdmin as $admin)
                <tr>
                  <td>
                    <div class="d-flex ali">
                      <div class="avatar avatar-sm me-4">
                      </div>
                      <div>
                        <h6 class="mb-0">{{ $admin->namaLengkap }}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="text-truncate">{{ $admin->email }}</td>
                  <td class="text-truncate">
                    <div class="d-flex align-items-center">
                      <i class="icon-base ri ri-vip-crown-line icon-22px text-primary me-2"></i>
                      <span>{{ $admin->role }}</span>
                    </div>
                  </td>
                  <td><span class="badge bg-label-warning rounded-pill">Aktif</span></td>
                  {{-- <td>
                    <form action="{{ route('admin.JadwalBarberman', $barberman->user_id) }}" method="GET">
                      <button type="submit" class="btn btn-success">Atur Jadwal</button>
                    </form>

                  </td> --}}
                </tr>

              @empty
                <tr>
                  <td colspan="4" class="text-center">Data admin belum tersedia.</td>
                </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
