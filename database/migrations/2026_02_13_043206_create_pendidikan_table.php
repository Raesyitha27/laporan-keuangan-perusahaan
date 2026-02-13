<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('pendidikan', function (Blueprint $table) {
        $table->integer('id')->primary(); // Sesuai gambar: int primary key
        $table->string('jenjang', 50);    // Sesuai gambar: varchar(50)
        $table->timestamps();
    });
}
};
