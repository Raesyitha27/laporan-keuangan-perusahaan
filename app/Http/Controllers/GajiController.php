<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{
    public function index(Request $request)
    {
        $filterBulan = $request->get('bulan'); 
        $query = Gaji::with('pegawai');

        if ($filterBulan) {
            $query->where('bulan_tahun', $filterBulan);
        }

        $allGaji = $query->get();
        return view('gaji.index', compact('allGaji', 'filterBulan'));
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        return view('gaji.create', compact('pegawai'));
    }

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

        // 2. Catat/Update ke Tabel Transaksi secara Otomatis
        // Kita buat nomor transaksi yang unik: GJ + ID Pegawai + BulanTahun
        // Contoh: GJ-1-202602
        $noTrans = 'GJ-' . $request->pegawai_id . '-' . str_replace('-', '', $request->bulan_tahun);

        DB::table('transaksi')->updateOrInsert(
            ['no_transaksi' => $noTrans], // Jika no_transaksi ini sudah ada, maka UPDATE
            [
                'no_rekening'      => '501', 
                'tanggal'          => now(),
                'id_debet_kredit'  => 2, 
                'debet'            => 0,
                'kredit'           => ($request->gaji_pokok + $request->tunjangan) - $request->pajak,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]
        );

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil disimpan dan sinkron dengan transaksi!');
    }

    public function downloadSlip($id)
    {
        $gaji = Gaji::with('pegawai')->findOrFail($id);
        $pdf = Pdf::loadView('gaji.slip', compact('gaji'));
        return $pdf->download('Slip-Gaji-'.$gaji->pegawai->nama.'-'.$gaji->bulan_tahun.'.pdf');
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('gaji.edit', compact('gaji', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        // Untuk konsistensi, kita arahkan fungsi update ke store 
        // karena store kita sudah pakai updateOrCreate.
        return $this->store($request);
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);

        // Hapus juga transaksi terkait agar saldo kembali benar
        $noTrans = 'GJ-' . $gaji->pegawai_id . '-' . str_replace('-', '', $gaji->bulan_tahun);
        DB::table('transaksi')->where('no_transaksi', $noTrans)->delete();

        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Data gaji dan transaksi terkait berhasil dihapus!');
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan');
        $query = Gaji::with('pegawai');

        if ($bulan) {
            $query->where('bulan_tahun', $bulan);
        }

        $allGaji = $query->get();
        $pdf = Pdf::loadView('gaji.pdf', compact('allGaji', 'bulan'));
        
        return $pdf->download('laporan-gaji-'.($bulan ?? 'semua').'.pdf');
    }
}