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
    Schema::create('pegawai', function (Blueprint $table) {
        $table->string('no_pegawai', 20)->primary(); // Sesuai gambar: varchar(20)
        $table->string('nama', 100);
        $table->integer('id');    // Relasi ke pendidikan
        $table->integer('nomor'); // Relasi ke bagian
        $table->string('jabatan', 100);
        $table->timestamps();
    });
}
};
