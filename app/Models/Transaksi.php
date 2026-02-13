<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'no_transaksi'; // Sesuai gambar: int
    public $incrementing = false; // Jika di phpMyAdmin tidak diceklis A_I (Auto Increment)

    protected $fillable = ['no_transaksi', 'no_rekening', 'tanggal', 'id_debet_kredit', 'debet', 'kredit'];

    // Relasi ke Rekening
    public function rekening() {
        return $this->belongsTo(Rekening::class, 'no_rekening', 'no_rekening');
    }
}