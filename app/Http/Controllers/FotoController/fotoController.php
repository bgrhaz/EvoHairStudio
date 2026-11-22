<?php

namespace App\Http\Controllers\FotoController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class fotoController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    $foto = Foto::where('user_id', $user_id)->first();
    return view('content.barberman-interface.UploadFoto', compact('foto'));
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
    $user_id = Auth::id();
    $request->validate([
      'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    ]);

    $path = $request->file('foto')->store('fotos', 'public');
    Foto::create([
      'user_id' => $user_id,
      'foto' => $path
    ]);
    return redirect()->route('barberman.foto');
  }



  public function destroy($id)
  {
    // Cari data foto berdasarkan ID
    $foto = Foto::findOrFail($id);

    // Hapus file foto dari storage
    Storage::disk('public')->delete($foto->foto);

    // Hapus data foto dari database
    $foto->delete();

    return redirect()->back()->with('success', 'Foto berhasil dihapus!');
  }
}
