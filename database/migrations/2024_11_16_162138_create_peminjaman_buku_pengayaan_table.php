<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_buku_pengayaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_judul_buku');
            $table->unsignedBigInteger('id_detail_buku');
            $table->dateTime('tgl_pinjam');
            $table->dateTime('tgl_pengembalian');
            $table->string('peminjam');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_detail_buku')->references('id')->on('detail_enrichment_book');
            $table->foreign('id_judul_buku')->references('id')->on('enrichment_book');
            $table->foreign('id_siswa')->references('id')->on('students');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_buku_pengayaans');
    }
};
