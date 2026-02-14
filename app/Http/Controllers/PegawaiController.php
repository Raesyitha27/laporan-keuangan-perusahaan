<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use App\Models\Bagian;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // Menggunakan orderBy('id') sebagai pengganti latest()
        $pegawai = Pegawai::with(['pendidikan', 'bagian'])->orderBy('id', 'desc')->get();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai'    => 'required|unique:pegawai,no_pegawai',
            'nama'          => 'required|string|max:255',
            'jabatan'       => 'required|string',
            'tanggal_masuk' => 'required|date',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'bagian_id'     => 'required|exists:bagian,nomor', 
        ]);

        try {
            Pegawai::create($request->all());
            return redirect()->route('pegawai.index')->with('success', 'Data Pegawai Berhasil Disimpan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal Simpan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Dihapus!');
    }
}