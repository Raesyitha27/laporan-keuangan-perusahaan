<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening'; // Pastikan nama tabelnya 'rekening' di SQL
    protected $primaryKey = 'no_rekening'; 
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['no_rekening', 'nama_rekening', 'saldo'];
}