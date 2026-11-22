@extends('layouts/admin-layout/app')
@section('title', 'Atur Jadwal Barberman')

@section('content')
  <div class="row g-4">
    <!-- Kolom Kiri: Profil Barberman -->
    <div class="col-12 col-md-4">
      <div class="card text-center h-100">
        <div class="card-header pb-0">
          <span class="badge bg-label-primary">Detail Barberman</span>
        </div>
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
          <div class="mb-3">
            <img
              src="{{ $foto?->foto ? asset('storage/' . $foto->foto) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGObwesziwXc9pgxqwuh1F4rMKnD3IbDb0A6K9HFYNHw&s=10' }}"
              alt="Foto Barberman" class="rounded-circle object-fit-cover border border-2 border-primary" width="110"
              height="110">
          </div>
          <h5 class="card-title mb-1">{{ $barberman->nama_pegawai }}</h5>
          <span class="badge bg-label-success mb-2">Aktif</span>
          <p class="text-muted small mb-0">Siap melayani potongan rambut dan perawatan terbaik untuk Anda.</p>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Form Pengaturan Jam Ketersediaan -->
    <div class="col-12 col-md-8">
      <div class="card h-100">
        {{-- route('jadwal.simpan', $barberman->id_pegawai) --}}
        <form action="{{ route('admin.SimpanJadwalBarberman', $barberman->id_pegawai) }}" method="POST">
          @csrf

          <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
            <div>
              <h5 class="card-title mb-0">Atur Jam Ketersediaan</h5>
              <small class="text-muted">Centang slot jam kerja yang tersedia untuk barberman ini</small>
            </div>
            @if ($jamMaster->isNotEmpty())
              <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" id="checkAll">
                <label class="form-check-label fw-semibold cursor-pointer" for="checkAll">
                  Pilih Semua
                </label>
              </div>
            @endif
          </div>

          <div class="card-body pt-4">
            <div class="row g-3">
              @forelse ($jamMaster as $jam)
                <div class="col-6 col-sm-4 col-xl-3">
                  <label
                    class="slot-jam border rounded p-3 d-flex align-items-center justify-content-center gap-2 cursor-pointer w-100 h-100 mb-0"
                    for="jam_{{ $jam->id_jam }}">
                    <input class="form-check-input item-jam mt-0" type="checkbox" name="jam_ids[]"
                      value="{{ $jam->id_jam }}" id="jam_{{ $jam->id_jam }}"
                      {{ in_array($jam->id_jam, $jadwalTerpilih) ? 'checked' : '' }}>
                    <span class="fw-medium text-nowrap">
                      {{ \Carbon\Carbon::parse($jam->jam)->format('H:i') }}
                    </span>
                  </label>
                </div>
              @empty
                <div class="col-12">
                  <div class="alert alert-warning mb-0 text-center">
                    Data master jam belum tersedia. Silakan tambahkan data jam terlebih dahulu.
                  </div>
                </div>
              @endforelse
            </div>
          </div>

          @if ($jamMaster->isNotEmpty())
            <div class="card-footer border-top d-flex justify-content-end gap-2">
              <a href="{{ route('admin.akunBarberman') }}" class="btn btn-label-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-1"></i> Simpan Jadwal
              </button>
            </div>
          @endif
        </form>
      </div>
    </div>
  </div>

  <!-- CSS Tambahan agar Efek Hover & Checked Terlihat Jelas -->
  <style>
    .cursor-pointer {
      cursor: pointer;
    }

    .slot-jam {
      transition: all 0.2s ease;
      user-select: none;
    }

    .slot-jam:hover {
      border-color: #696cff !important;
      background-color: rgba(105, 108, 255, 0.04);
    }

    .slot-jam:has(.item-jam:checked) {
      border-color: #696cff !important;
      background-color: rgba(105, 108, 255, 0.1);
      color: #696cff;
    }
  </style>

  <!-- Script Pilih Semua -->
  <script>
    const checkAll = document.getElementById('checkAll');
    const itemJams = document.querySelectorAll('.item-jam');

    if (checkAll) {
      checkAll.checked = itemJams.length > 0 && Array.from(itemJams).every(cb => cb.checked);

      checkAll.addEventListener('change', function() {
        itemJams.forEach(cb => cb.checked = this.checked);
      });

      itemJams.forEach(cb => {
        cb.addEventListener('change', function() {
          checkAll.checked = Array.from(itemJams).every(item => item.checked);
        });
      });
    }
  </script>
@endsection
