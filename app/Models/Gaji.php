<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $fillable = ['pegawai_id', 'gaji_pokok', 'tunjangan', 'pajak', 'bulan_tahun'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    /**
     * Accessor untuk mendapatkan tunjangan otomatis berdasarkan masa kerja pegawai
     */
    public function getTunjanganOtomatisAttribute()
    {
        // Cek apakah relasi pegawai ada dan punya tanggal_masuk
        if (!$this->pegawai || !$this->pegawai->tanggal_masuk) {
            return 0;
        }

        $tglMasuk = Carbon::parse($this->pegawai->tanggal_masuk);

        // Hitung selisih tahun secara bulat (Integer)
        $masaKerjaTahun = (int) $tglMasuk->diffInYears(now());

        // Logika: 1 Juta per tahun kerja
        return $masaKerjaTahun * 1000000;
    }
}