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
        Schema::create('detail_peminjaman_buku_paket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pinjam');
            $table->unsignedBigInteger('id_buku_paket');
            $table->string('status_peminjaman');
            $table->timestamps();

            $table->foreign('id_pinjam')->references('id')->on('peminjaman_buku_paket')->onDelete('cascade');
            $table->foreign('id_buku_paket')->references('id')->on('detail_package_books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman_buku_paket');
    }
};
