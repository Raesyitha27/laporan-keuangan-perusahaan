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
    Schema::create('transaksi', function (Blueprint $table) {
        $table->integer('no_transaksi')->primary();
        $table->string('no_rekening', 20);
        $table->date('tanggal');
        $table->integer('id_debet_kredit');
        $table->decimal('debet', 15, 2);
        $table->decimal('kredit', 15, 2);
        
        // Relasi
        $table->foreign('no_rekening')->references('no_rekening')->on('rekening');
        $table->timestamps();
    });
}
};
