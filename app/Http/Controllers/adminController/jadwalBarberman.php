<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use App\Models\master_jam;
use App\Models\jadwal_barberman;
use App\Models\Foto;

class jadwalBarberman extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($id)
  {
    $barberman = Pegawai::where('user_id', $id)->firstOrFail();
    $foto = Foto::where('user_id', $id)->first();

    // Ambil semua master jam urut dari pagi ke malam
    $jamMaster = master_jam::orderBy('jam', 'asc')->get();

    // Ambil daftar id_jam yang sudah dipilih barberman ini dalam bentuk array
    $jadwalTerpilih = jadwal_barberman::where('id_pegawai', $barberman->id_pegawai)->pluck('id_jam')->toArray();

    return view('content.admin-interface.jadwalBarberman', compact('barberman', 'jamMaster', 'jadwalTerpilih', 'foto'));
  }

  public function store(Request $request, $id)
  {
    $request->validate([
      'jam_ids'   => 'nullable|array',
      'jam_ids.*' => 'exists:master_jam,id_jam', // Sesuaikan 'jam,id_jam' dengan nama tabel & PK Anda
    ]);

    $barberman = Pegawai::findOrFail($id);

    $jamIds = $request->input('jam_ids', []);

    // 3. Sinkronisasi ke tabel jadwal_barberman menggunakan Transaction
    DB::transaction(function () use ($barberman, $jamIds) {
      // Hapus seluruh jadwal lama milik barberman ini
      jadwal_barberman::where('id_pegawai', $barberman->id_pegawai)->delete();

      // Jika ada jam yang dicentang, masukkan data baru sekaligus (bulk insert)
      if (!empty($jamIds)) {
        $dataInsert = [];

        foreach ($jamIds as $idJam) {
          $dataInsert[] = [
            'id_pegawai'   => $barberman->id_pegawai,
            'id_jam'       => $idJam,
            'jam' => master_jam::where('id_jam', $idJam)->value('jam')
          ];
        }

        jadwal_barberman::insert($dataInsert);
      }
    });
    return redirect()->back()->with('success', 'Jadwal ketersediaan barberman berhasil diperbarui.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
