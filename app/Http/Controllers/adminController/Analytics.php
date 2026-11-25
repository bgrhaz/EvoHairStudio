<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\master_jam;
use App\Models\jadwal_barberman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Tranksaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pesan;

class Analytics extends Controller
{
  public function index()
  {
    $penghasilan = Tranksaksi::where('tanggal_transaksi', today())->get();

    $reservasiOnline = Pelanggan::join('reservasi', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
      ->join('layanan', 'layanan.id_layanan', '=', 'reservasi.id_layanan')
      ->join('pegawai', 'pegawai.id_pegawai', '=', 'reservasi.id_pegawai')
      ->where('reservasi.jalur_reservasi', 'Online')
      ->where('reservasi.status_reservasi', 'belum selesai')
      ->whereDate('reservasi.tanggal_reservasi', today())
      ->orderBy('jam_mulai')
      ->select('reservasi.*', 'pelanggan.*', 'layanan.*', 'pegawai.nama_pegawai')->get();

    $reservasiOffline = Pelanggan::join('reservasi', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
      ->join('layanan', 'layanan.id_layanan', '=', 'reservasi.id_layanan')
      ->join('pegawai', 'pegawai.id_pegawai', '=', 'reservasi.id_pegawai')
      ->where('reservasi.jalur_reservasi', 'Offline')
      ->where('reservasi.status_reservasi', 'belum selesai')
      ->whereDate('reservasi.tanggal_reservasi', today())
      ->orderBy('jam_mulai')
      ->select('reservasi.*', 'pelanggan.*', 'layanan.*', 'pegawai.nama_pegawai')->get();

    $barberman = Pegawai::where('status_aktif', 'aktif')->get();
    $layanan = Layanan::all();

    $jadwal = master_jam::all();


    return view(
      'content.admin-interface.dashboards',
      compact('reservasiOnline', 'barberman', 'jadwal', 'layanan', 'reservasiOffline', 'penghasilan')
    );
  }


  public function cekJadwal(Request $request, $id)
  {
    $request->validate([
      'tanggal_reservasi' => 'required|date'
    ]);

    // Ambil seluruh jadwal milik barberman
    $jadwal = DB::table('jadwal_barberman')
      ->where('id_pegawai', $id)
      ->get();

    // Ambil ID jadwal yang sudah dipesan pada tanggal tersebut
    $waktuTerpakai = Reservasi::where('id_pegawai', $id)
      ->whereDate('tanggal_reservasi', $request->tanggal_reservasi)
      ->pluck('id_jadwal')
      ->toArray();

    // Gabungkan jadwal dengan status pemesanan
    $hasil = $jadwal->map(function ($item) use ($waktuTerpakai) {

      return [
        'id_jadwal' => $item->id_jadwal,
        'id_jam' => $item->id_jam,
        'jam' => $item->jam,
        'terpakai' => in_array(
          $item->id_jadwal,
          $waktuTerpakai
        )
      ];
    });

    return response()->json($hasil);
  }


  public function akunBarberman()
  {
    $dataBarberman = User::where('role', 'barberman')->get();
    return view('content.admin-interface.akunBarberman', compact('dataBarberman'));
  }

  public function akunAdmin()
  {
    $dataAdmin = User::where('role', 'admin')->get();
    return view('content.admin-interface.akunAdmin', compact('dataAdmin'));
  }

  public function transaksi(Request $request)
  {
    $user_id = Auth::id();
    $admin = Admin::where('user_id', $user_id)->first();

    $data['id_admin'] = $admin->id_admin;
    $data['id_reservasi'] = $request->id_reservasi;
    $data['nama_pelanggan'] = $request->nama_pelanggan;
    $data['total_bayar'] = $request->total_bayar;
    $data['kembalian'] = $request->kembalian;
    $data['uang_diterima'] = $request->uang_diterima;
    $data['id_pegawai'] = $request->id_pegawai;
    $data['kode_reservasi'] = $request->kode_reservasi;
    $data['metode_pembayaran'] = 'Tunai';
    $data['id_layanan'] = $request->id_layanan;

    Tranksaksi::create([
      'id_reservasi' => $data['id_reservasi'],
      'id_pegawai' => $data['id_pegawai'],
      'id_admin' => $data['id_admin'],
      'id_kategori' => $data['id_layanan'],
      'nama_pelanggan' =>  $data['nama_pelanggan'],
      'nomor_antrian' => $data['kode_reservasi'],
      'tanggal_transaksi' => today(),
      'total_bayar' =>  $data['total_bayar'],
      'metode_pembayaran' => $data['metode_pembayaran'],
      'uang_dibayar' =>  $data['uang_diterima'],
      'kembalian' => $data['kembalian']
    ]);

    $reservasi = Reservasi::find($data['id_reservasi']);
    $reservasi->update([
      'status_reservasi' => 'selesai'
    ]);

    $layanan = Layanan::where('id_layanan', $data['id_layanan'])->first();
    $nama_layanan = $layanan->nama_layanan;
    $harga_layanan = $layanan->harga;
    $tanggal = now()->format('Y-m-d');
    $uang_bayar = $data['uang_diterima'];
    $kembalian = $data['kembalian'];

    //Ambil id_pelanggan lalu cari user_idnya, lalu kirim pesan;
    $id_pelanggan = $request->id_pelanggan;
    $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();
    $user_id_pelanggan = $pelanggan->user_id;
    $subjek = 'Transaksi Layanan Selesai';
    $pesan =
      "Transaksi telah berhasil dilakukan\n" .
      "Tanggal : $tanggal \n" .
      "Layanan : $nama_layanan \n" .
      "Harga : $harga_layanan \n" .
      "Uang Bayar : $uang_bayar \n" .
      "Kembalian : $kembalian \n" .
      "Terima kasih, Kepuasan anda adalah\n" .
      "prioritas kami";


    Pesan::create([
      'id_user' => $user_id_pelanggan,
      'nama_pengirim' => 'Sistem',
      'email' => $admin->email,
      'nomor_hp' => $admin->nomor_hp,
      'subjek' => $subjek,
      'pesan' => $pesan,
      'tanggal' => $tanggal,
      'dibaca' => 0
    ]);


    return redirect()->route('admin.dashboard');
  }

  public function halamanTransaksi()
  {
    $dataAdmin = Tranksaksi::join('admin', 'admin.id_admin', '=', 'transaksi.id_admin')
      ->join('layanan', 'layanan.id_layanan', '=', 'transaksi.id_kategori')
      ->orderBy('transaksi.id_transaksi', 'desc')
      ->select('admin.*', 'transaksi.*', 'layanan.*')->paginate(10);

    return view('content.admin-interface.transaksi', compact('dataAdmin'));
  }


  public function store(Request $request)
  {

    $data['id_pegawai'] = $request->id_pegawai; //ada
    // $data['user_id'] = $request->user_id; // TIDAK ADA
    $data['nama_pelanggan'] = $request->nama_pelanggan; //ada
    $data['id_layanan'] = $request->id_layanan; //ada
    $data['tanggal_reservasi'] = $request->tanggal_reservasi; //ada
    $id_jadwal = $request->id_jadwal; //ada

    $pelanggan = pelanggan::create([
      'user_id' => 0,
      'nama_pelanggan' => $data['nama_pelanggan'],
      'email' => '',
      'nomor_hp' => ''
    ]);
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
    $jalur = 'Offline';

    Reservasi::create([
      'id_pelanggan' => $pelanggan->id_pelanggan,
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

    return redirect()->route('admin.dashboard');
  }
}
