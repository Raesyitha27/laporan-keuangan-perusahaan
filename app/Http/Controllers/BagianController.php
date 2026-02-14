<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all(); 
        return view('bagian.index', compact('bagian'));
    }

    public function create()
    {
        return view('bagian.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi: Sesuaikan dengan input di form kamu
        $request->validate([
            'nomor'  => 'required|unique:bagian,nomor',
            'bagian' => 'required', // Diubah dari 'nama_bagian' agar sesuai DB
        ]);

        // 2. Simpan: Sesuaikan key dengan nama kolom di tabel MySQL
        Bagian::create([
            'nomor'  => $request->nomor,
            'bagian' => $request->bagian, // Diubah dari 'nama_bagian'
        ]);

        return redirect()->route('bagian.index')->with('success', 'Data Bagian berhasil ditambahkan!');
    }

    public function destroy($nomor) // Gunakan $nomor karena PK kamu adalah 'nomor'
    {
        $bagian = Bagian::findOrFail($nomor);
        $bagian->delete();

        return redirect()->route('bagian.index')->with('success', 'Data Bagian berhasil dihapus!');
    }
}