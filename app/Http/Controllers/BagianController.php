<?php

namespace App\Http\Controllers;

use App\Models\Bagian; // Memanggil Model Bagian yang benar
use Illuminate\Http\Request;

class BagianController extends Controller
{
    /**
     * Menampilkan daftar semua bagian
     */
    public function index()
    {
        // Mengambil semua data bagian dari database SQL
        $bagian = Bagian::all(); 
        
        // Mengirim data ke view index di folder resources/views/bagian/
        return view('bagian.index', compact('bagian'));
    }

    /**
     * Menampilkan form untuk menambah bagian baru
     */
    public function create()
    {
        return view('bagian.create');
    }

    /**
     * Menyimpan data bagian baru ke database SQL
     */
    public function store(Request $request)
    {
        // Validasi input: 'nomor' harus diisi dan unik di tabel bagian
        $request->validate([
            'nomor' => 'required|unique:bagian,nomor',
            'nama_bagian' => 'required',
        ]);

        // Simpan ke database menggunakan metode mass assignment
        Bagian::create([
            'nomor' => $request->nomor,
            'nama_bagian' => $request->nama_bagian,
        ]);

        // Setelah simpan, balik ke halaman daftar dengan pesan sukses
        return redirect()->route('bagian.index')->with('success', 'Data Bagian berhasil ditambahkan!');
    }

    /**
     * Menghapus data bagian (Opsional, untuk pelengkap CRUD)
     */
    public function destroy($id)
    {
        $bagian = Bagian::findOrFail($id);
        $bagian->delete();

        return redirect()->route('bagian.index')->with('success', 'Data Bagian berhasil dihapus!');
    }
}