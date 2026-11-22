<?php

namespace App\Http\Controllers\pelangganController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\jadwal_barberman;
use App\Models\Layanan;
use App\Models\master_jam;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use Carbon\Carbon;
use App\Models\Foto;

class reservasiController extends Controller
{

  public function index($id)
  {
    //Mengambil foto barberman
    $pegawai = Pegawai::where('id_pegawai', $id)->first();
    $user_id = $pegawai->user_id;
    $foto = Foto::where('user_id', $user_id)->first();

    $barberman = Pegawai::findOrFail($id);
    $layanan = Layanan::all();

    $jadwal = master_jam::leftJoin('jadwal_barberman', function ($join) use ($id) {
      $join->on('master_jam.id_jam', '=', 'jadwal_barberman.id_jam')
        ->where('jadwal_barberman.id_pegawai', $id);
    })
      ->select(
        'master_jam.*',
        'jadwal_barberman.id_jadwal'
      )
      ->get();

    return view('content.pelanggan-interface.AjukanReservasi', compact('barberman', 'layanan', 'jadwal', 'foto'));
  }

  public function cekJadwal(Request $request, $id)
  {
    $tanggal = $request->tanggal_reservasi;

    $waktuTerpakai = Reservasi::where('id_pegawai', $id)
      ->whereDate('tanggal_reservasi', $tanggal)
      ->pluck('id_jadwal')
      ->toArray();

    return response()->json($waktuTerpakai);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data['id_pegawai'] = $request->id_pegawai;
    $data['user_id'] = $request->user_id;
    $data['nama_pelanggan'] = $request->nama_pelanggan;
    $data['id_layanan'] = $request->id_layanan;
    $data['tanggal_reservasi'] = $request->tanggal_reservasi;
    $id_jadwal = $request->id_jadwal;

    // Mengambil id_pelanggan
    $Pelanggan = Pelanggan::where('user_id', $data['user_id'])->firstOrFail();
    $id_pelanggan = $Pelanggan->id_pelanggan;

    // Mengambil Durasi
    $layanan = Layanan::findOrFail($data['id_layanan']);
    $durasi = $layanan->durasi;

    $total_bayar = $layanan->harga;

    // Mengambil jam_mulai dari table master_jam
    $jadwal_barberman = jadwal_barberman::where('id_jadwal', $id_jadwal)->firstOrFail();
    $id_jam = $jadwal_barberman->id_jam;

    $master_jam = master_jam::where('id_jam', $id_jam)->firstOrFail();
    $jam = $master_jam->jam;

    $jam_selesai = Carbon::parse($jam)
      ->addMinutes($durasi)
      ->format('H:i:s');

    $status_reservasi = 'belum selesai';
    $jalur = 'Online';

    Reservasi::create([
      'id_pelanggan' => $id_pelanggan,
      'id_pegawai' => $data['id_pegawai'],
      'id_layanan' => $data['id_layanan'],
      'id_jadwal' => $id_jadwal,
      'tanggal_reservasi' => $data['tanggal_reservasi'],
      'jam_mulai' => $jam,
      'jam_selesai' => $jam_selesai,
      'total_bayar' => $total_bayar,
      'status_reservasi' => $status_reservasi,
      'jalur_reservasi' => $jalur
    ]);

    return redirect()->route('halamanPelanggan');
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
