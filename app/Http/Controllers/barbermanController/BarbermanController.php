<?php

namespace App\Http\Controllers\barbermanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tranksaksi;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\master_jam;
use App\Models\jadwal_barberman;
use Illuminate\Support\Facades\Auth;

class BarbermanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    $user_id = Auth::User()->user_id;
    $pegawai = Pegawai::where('user_id', $user_id)->first();

    $penghasilan = Tranksaksi::where('tanggal_transaksi', today())
      ->where('id_pegawai', $pegawai->id_pegawai)
      ->get();

    $reservasiOnline = Pelanggan::join('reservasi', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
      ->join('layanan', 'layanan.id_layanan', '=', 'reservasi.id_layanan')
      ->join('pegawai', 'pegawai.id_pegawai', '=', 'reservasi.id_pegawai')
      ->where('reservasi.jalur_reservasi', 'Online')
      ->where('reservasi.status_reservasi', 'belum selesai')
      ->where('reservasi.id_pegawai', $pegawai->id_pegawai)
      ->whereDate('reservasi.tanggal_reservasi', today())
      ->orderBy('jam_mulai')
      ->select('reservasi.*', 'pelanggan.*', 'layanan.*', 'pegawai.nama_pegawai')->get();

    $reservasiOffline = Pelanggan::join('reservasi', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
      ->join('layanan', 'layanan.id_layanan', '=', 'reservasi.id_layanan')
      ->join('pegawai', 'pegawai.id_pegawai', '=', 'reservasi.id_pegawai')
      ->where('reservasi.jalur_reservasi', 'Offline')
      ->where('reservasi.status_reservasi', 'belum selesai')
      ->where('reservasi.id_pegawai', $pegawai->id_pegawai)
      ->whereDate('reservasi.tanggal_reservasi', today())
      ->orderBy('jam_mulai')
      ->select('reservasi.*', 'pelanggan.*', 'layanan.*', 'pegawai.nama_pegawai')->get();

    $barberman = Pegawai::where('status_aktif', 'aktif')->get();
    $layanan = Layanan::all();

    $jadwal = master_jam::all();

    return view('content.barberman-interface.Barberman', compact('reservasiOnline', 'barberman', 'jadwal', 'layanan', 'reservasiOffline', 'penghasilan'));
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
    //
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
