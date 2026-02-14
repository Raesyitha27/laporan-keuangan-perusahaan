<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    // 1. Set Primary Key ke no_transaksi
    protected $primaryKey = 'no_transaksi';

    // 2. WAJIB: Karena no_transaksi isinya 'GJ-4-202502' (String), 
    // maka incrementing harus false dan keyType harus string.
    public $incrementing = false;
    protected $keyType = 'string';

    // 3. Sesuaikan fillable dengan kolom yang ada di database kamu sekarang
    // Tambahkan 'keterangan' jika kolom tersebut ada di tabel transaksi
    protected $fillable = [
        'no_transaksi',
        'no_rekening',
        'tanggal',
        'keterangan',
        'debet',
        'kredit'
    ];

    // Relasi ke Rekening
    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'no_rekening', 'no_rekening');
    }
}