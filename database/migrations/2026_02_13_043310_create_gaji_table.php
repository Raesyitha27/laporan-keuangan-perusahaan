<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('gaji', function (Blueprint $table) {
        $table->string('no_pegawai', 20); 
        $table->decimal('gaji_pokok', 15, 2);   // Sesuai gambar: decimal(15,2)
        $table->decimal('faktor_perubah', 5, 2); // Sesuai gambar: decimal(5,2)
        
        // Relasi ke tabel pegawai
        $table->foreign('no_pegawai')->references('no_pegawai')->on('pegawai')->onDelete('cascade');
        $table->timestamps();
    });
}
};
