<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        // Mengambil semua data gaji beserta data pegawainya (Eager Loading)
        $gaji = Gaji::with('pegawai')->get();
        return view('gaji.index', compact('gaji'));
    }

    public function create()
    {
        $pegawai = Pegawai::all(); // Untuk dropdown pilih pegawai
        return view('gaji.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'gaji_pokok' => 'required|numeric',
            // Tambahkan validasi lain sesuai kolom di SQL kamu
        ]);

        Gaji::create($request->all());

        return redirect()->route('gaji.index')->with('success', 'Data Gaji berhasil disimpan!');
    }
}