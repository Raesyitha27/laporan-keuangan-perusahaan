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
    Schema::create('bagian', function (Blueprint $table) {
        $table->integer('nomor')->primary(); // Sesuai gambar: int primary key
        $table->string('bagian', 100);       // Sesuai gambar: varchar(100)
        $table->timestamps();
    });
}
};
