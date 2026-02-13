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
    Schema::create('rekening', function (Blueprint $table) {
        $table->string('no_rekening', 20)->primary();
        $table->string('nama_rekening', 100);
        $table->string('rek_level_1', 100);
        $table->string('rek_level_2', 100);
        $table->timestamps();
    });
}
};
