<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'debet_kredit';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'jenis'];
 }