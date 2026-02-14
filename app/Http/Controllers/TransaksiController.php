<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil semua data transaksi, urutkan dari yang terbaru
        $transaksi = DB::table('transaksi')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total saldo (Debet - Kredit)
        $totalDebet = $transaksi->sum('debet');
        $totalKredit = $transaksi->sum('kredit');
        $saldoAkhir = $totalDebet - $totalKredit;

        return view('transaksi.index', compact('transaksi', 'totalDebet', 'totalKredit', 'saldoAkhir'));
    }
}