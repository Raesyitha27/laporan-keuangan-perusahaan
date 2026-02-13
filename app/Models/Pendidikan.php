<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan'; // Nama tabel di SQL
    protected $primaryKey = 'id';    // Primary key tabel
    public $timestamps = false;      // Matikan jika tidak ada created_at/updated_at
    
    protected $fillable = ['id', 'jenjang'];

    // Relasi ke Pegawai (Satu pendidikan dipakai banyak pegawai)
    public function pegawai() {
        return $this->hasMany(Pegawai::class, 'id', 'id');
    }
}