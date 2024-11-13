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
        Schema::create('detail_enrichment_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengayaan');
            $table->string('status_peminjaman');
            $table->integer('no_induk');
            $table->timestamps();

            $table->foreign('id_pengayaan')->references('id')->on('enrichment_book');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_enrichment_book');
    }
};
