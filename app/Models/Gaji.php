<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    // Sesuaikan Primary Key. Di database kamu, kolomnya adalah 'id' (auto_increment)
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pegawai_id',  // Ganti dari no_pegawai ke pegawai_id
        'gaji_pokok', 
        'tunjangan', 
        'pajak', 
        'bulan_tahun'
    ];

    // Relasi ke Pegawai (Inilah kunci agar Nama muncul)
    public function pegawai()
    {
        // Parameter 2: Foreign Key di tabel gaji (pegawai_id)
        // Parameter 3: Primary Key di tabel pegawai (id)
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}