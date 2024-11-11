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
        Schema::create('enrichment_book', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_masuk');
            $table->string('judul');
            $table->integer('tahun');
            $table->string('pengarang');
            $table->integer('eksemplar');
            $table->string('penerbit');
            $table->unsignedBigInteger('id_rak');
            $table->timestamps();
            
            $table->foreign('id_rak')->references('id')->on('bookcases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrichment_book');
    }
};
