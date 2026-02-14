<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    
    // PENTING: Matikan timestamps karena tabel kamu tidak punya kolom created_at
    public $timestamps = false; 

    protected $fillable = [
        'no_pegawai',
        'nama',
        'pendidikan_id',
        'bagian_id',
        'jabatan',
        'tanggal_masuk',
    ];

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_id');
    }

    public function bagian()
    {
        // Relasi ke tabel bagian menggunakan kolom 'nomor'
        return $this->belongsTo(Bagian::class, 'bagian_id', 'nomor');
    }
}