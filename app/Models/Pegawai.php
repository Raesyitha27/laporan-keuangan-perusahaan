<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'no_pegawai'; 
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false; // Sudah benar, mencegah error jika kolom created_at tidak ada

    protected $fillable = ['no_pegawai', 'nama', 'id', 'nomor', 'jabatan'];

    // 1. Relasi ke Gaji (Satu pegawai punya satu data gaji)
    public function gaji() {
        return $this->hasOne(Gaji::class, 'no_pegawai', 'no_pegawai');
    }

    // 2. Relasi ke Bagian (Satu pegawai terdaftar di satu bagian)
    // Berdasarkan kolom 'nomor' di tabel pegawai
    public function bagian() {
        return $this->belongsTo(Bagian::class, 'nomor', 'nomor');
    }

    // 3. Relasi ke Pendidikan (Satu pegawai memiliki satu tingkat pendidikan)
    // Berdasarkan kolom 'id' di tabel pegawai
    public function pendidikan() {
        return $this->belongsTo(Pendidikan::class, 'id', 'id');
    }
}