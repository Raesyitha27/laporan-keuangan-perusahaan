<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'bagian';
    protected $primaryKey = 'nomor';

    // Berdasarkan SELECT kamu sebelumnya, nomor berisi angka 1, 2, 3...
    // Jika di MySQL tipenya INT dan otomatis nambah, biarkan true.
    // Jika kamu ketik manual nomornya di DB, biarkan false.
    public $incrementing = true; 
    
    // Jika nomor adalah angka, gunakan 'int'. Jika ada huruf, gunakan 'string'.
    protected $keyType = 'int'; 

    // Matikan ini jika tabel 'bagian' tidak punya kolom created_at & updated_at
    public $timestamps = false;

    protected $fillable = ['nomor', 'bagian'];

    /**
     * Relasi ke Pegawai (One to Many)
     */
    public function pegawai() 
    {
        // Parameter: (ModelTujuan, Foreign_Key_di_tabel_pegawai, Local_Key_di_tabel_bagian)
        return $this->hasMany(Pegawai::class, 'bagian_id', 'nomor');
    }
}