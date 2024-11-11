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
        Schema::create('detail_package_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_package_books');
            $table->integer('nomor_induk');

            $table->foreign('id_package_books')->references('id')->on('package_books')->onDelete('cascade');
            $table->string('status_peminjaman');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_detail_package_books');
    }
};
