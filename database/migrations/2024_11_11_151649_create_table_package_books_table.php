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
        Schema::create('package_books', function (Blueprint $table) {
            $table->id();
            $table->datetime('tgl_masuk');
            $table->string('judul');
            $table->string('tahun_terbit');
            $table->string('penerbit');
            $table->integer('eksemplar');
            $table->string('sumber');


            // Tambahkan kolom foreign key
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_submapel');
            $table->unsignedBigInteger('id_subkelas');

            // Definisikan relasi foreign key
            $table->foreign('id_jenis')->references('id')->on('type_books')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('id_submapel')->references('id')->on('sub_courses')->onDelete('cascade');
            $table->foreign('id_subkelas')->references('id')->on('sub_class')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_package_books');
    }
};
