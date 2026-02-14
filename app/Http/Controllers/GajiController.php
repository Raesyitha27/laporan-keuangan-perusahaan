<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    /**
     * Menampilkan daftar semua gaji.
     */
    public function index(Request $request)
{
    // Ambil input filter bulan dari request (jika ada)
    $filterBulan = $request->get('bulan'); 

    // Query dasar: Ambil gaji beserta data pegawainya
    $query = Gaji::with('pegawai');

    // Jika user memilih bulan tertentu, saring datanya
    if ($filterBulan) {
        $query->where('bulan_tahun', $filterBulan);
    }

    $allGaji = $query->get();

    return view('gaji.index', compact('allGaji', 'filterBulan'));
}

    /**
     * Menampilkan form tambah gaji.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('gaji.create', compact('pegawai'));
    }

    /**
     * Menyimpan data baru atau memperbarui data berdasarkan pegawai & bulan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id'  => 'required|exists:pegawai,id',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan'   => 'required|numeric',
            'pajak'       => 'required|numeric',
            'bulan_tahun' => 'required|string|max:7',
        ]);

        // 1. Simpan atau Update data Gaji
        $gaji = Gaji::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id, 'bulan_tahun' => $request->bulan_tahun],
            [
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan'  => $request->tunjangan,
                'pajak'      => $request->pajak,
            ]
        );

    // 2. Catat ke Tabel Transaksi (Otomatis)
    // Kita gunakan DB facade agar lebih cepat atau buat Model Transaksi
    \DB::table('transaksi')->insert([
        'no_transaksi'     => 'GJ-' . time() . '-' . $request->pegawai_id,
        'no_rekening'      => '111', // Contoh: Kode akun beban gaji
        'tanggal'          => now(),
        'id_debet_kredit'  => 2, // Misal 2 adalah kode untuk Kredit/Keluar
        'debet'            => 0,
        'kredit'           => $gaji->total_diterima, // Total yang dibayarkan
        'created_at'       => now(),
        'updated_at'       => now(),
    ]);

    return redirect()->route('gaji.index')->with('success', 'Gaji berhasil disimpan dan dicatat di transaksi!');
}

    // Fungsi Baru: Download Slip Gaji Per Orang
    public function downloadSlip($id)
    {
        $gaji = Gaji::with('pegawai')->findOrFail($id);
        
        // Gunakan view yang berbeda khusus untuk slip (bukan laporan tabel)
        $pdf = Pdf::loadView('gaji.slip', compact('gaji'));
        
        return $pdf->download('Slip-Gaji-'.$gaji->pegawai->nama.'-'.$gaji->bulan_tahun.'.pdf');
    }

    /**
     * Menampilkan form edit untuk data gaji spesifik.
     */
    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('gaji.edit', compact('gaji', 'pegawai'));
    }

    /**
     * Memperbarui data gaji (jika kamu menggunakan route resource 'update').
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id'  => 'required|exists:pegawai,id',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan'   => 'required|numeric',
            'pajak'       => 'required|numeric',
            'bulan_tahun' => 'required|string|max:7',
        ]);

        $gaji = Gaji::findOrFail($id);
        $gaji->update($request->all());

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui!');
    }

    /**
     * Menghapus data gaji.
     */
    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus!');
    }

    /**
     * Export data gaji ke file PDF.
     */
   public function exportPdf(Request $request)
{
    $bulan = $request->get('bulan');
    $query = Gaji::with('pegawai');

    if ($bulan) {
        $query->where('bulan_tahun', $bulan);
    }

    $allGaji = $query->get();
    $pdf = Pdf::loadView('gaji.pdf', compact('allGaji', 'bulan'));
    
    return $pdf->download('laporan-gaji-'.$bulan.'.pdf');
}
}