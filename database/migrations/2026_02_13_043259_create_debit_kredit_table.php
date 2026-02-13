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
    Schema::create('debet_kredit', function (Blueprint $table) {
        $table->integer('id')->primary();
        $table->string('jenis', 10); // Debet atau Kredit
        $table->timestamps();
    });
}
};
