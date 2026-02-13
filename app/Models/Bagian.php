<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model // Ubah dari Rekening menjadi Bagian
{
    protected $table = 'bagian';
    protected $primaryKey = 'nomor';
    public $incrementing = false; // Jika 'nomor' diisi manual (bukan angka urut otomatis)
    protected $keyType = 'string'; // Jika 'nomor' berisi huruf/karakter
    public $timestamps = false; // Matikan jika di tabel SQL tidak ada kolom created_at/updated_at

    protected $fillable = ['nomor', 'bagian']; // Sesuaikan dengan kolom di SQL kamu

    // Relasi ke Pegawai (Satu bagian memiliki banyak pegawai)
    public function pegawai() {
        return $this->hasMany(Pegawai::class, 'nomor', 'nomor');
    }
}