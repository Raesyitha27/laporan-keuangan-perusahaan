<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $primaryKey = 'no_pegawai'; // Sesuai dengan database kamu
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Bagian ini HARUS sama persis dengan nama kolom di database SQL
    protected $fillable = [
        'no_pegawai', 
        'gaji_pokok', 
        'faktor_perubah' // Ubah dari 'tunjangan' menjadi 'faktor_perubah'
    ];

    /**
     * Relasi ke model Pegawai
     * Sesuai flowchart: Menghubungkan data transaksi dengan identitas pegawai
     */
    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'no_pegawai', 'no_pegawai');
    }

    /**
     * Fitur Tambahan (Accessor): Menghitung Total Otomatis
     * Jadi kamu tidak perlu simpan kolom 'total' di database, 
     * panggil saja $gaji->total_pendapatan di View.
     */
    public function getTotalPendapatanAttribute()
    {
        return $this->gaji_pokok + $this->faktor_perubah;
    }
}