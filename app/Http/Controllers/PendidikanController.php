<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan; // Import Model Pendidikan
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel pendidikan di SQL
        $pendidikan = Pendidikan::all(); 
        
        // Mengirim data ke view index.blade.php
        return view('pendidikan.index', compact('pendidikan'));
    }

    public function create()
    {
        // Menampilkan form tambah data
        return view('pendidikan.create');
    }

    public function store(Request $request)
    {
        // Validasi input agar sesuai dengan struktur database
        $request->validate([
            'id' => 'required|unique:pendidikan,id',
            'jenjang' => 'required',
        ]);

        // Simpan data ke SQL
        Pendidikan::create($request->all());

        // Kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('pendidikan.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    // Fungsi lainnya (edit/update/destroy) bisa kamu isi nanti
}