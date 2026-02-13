<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
// Tidak perlu 'use App\Http\Controllers\Controller' jika berada di folder yang sama

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
{
    // 1. Validasi semua kolom yang ada di fillable Model
    $request->validate([
        'no_pegawai' => 'required|unique:pegawai,no_pegawai',
        'nama'       => 'required',
        'jabatan'    => 'required',
        'id'         => 'required', // Foreign key Pendidikan
        'nomor'      => 'required', // Foreign key Bagian
    ]);

    // 2. Simpan data ke Database SQL
    // Karena sudah divalidasi, kita bisa gunakan create($request->all())
    Pegawai::create($request->all());

    // 3. Redirect ke dashboard agar angka "Total Pegawai" langsung terupdate
    return redirect('/dashboard')->with('success', 'Data Pegawai Berhasil Disimpan ke SQL!');
}
}