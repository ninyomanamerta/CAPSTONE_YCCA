<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrichmentbook extends Model
{
    use HasFactory;
    protected $table = 'enrichment_book';

    protected $fillable = [
        'tgl_masuk',
        'kategori',
        'judul',
        'tahun',
        'pengarang',
        'eksemplar',
        'penerbit',
        'id_rak',
        'id_jenis',
        'id_mapel',
        'id_submapel',
        'id_subkelas',
        'id_subklasifikasi',
        'id_subklasifikasith',
    ];

    /**
     * Relasi dengan model Bookcase.
     * Setiap EnrichmentBook memiliki satu Bookcase.
     */
    public function bookcase()
    {
        return $this->belongsTo(Bookcase::class, 'id_rak');
    }

    public function detailEnrichmentBooks()
    {
        return $this->hasMany(detailenrichmentbook::class, 'id_pengayaan');
    }

    // Relasi dengan tabel type_books
    public function jenis()
    {
        return $this->belongsTo(BookType::class, 'id_jenis');
    }

    // Relasi dengan tabel courses
    public function mapel()
    {
        return $this->belongsTo(Course::class, 'id_mapel');
    }

    // Relasi dengan tabel sub_courses
    public function submapel()
    {
        return $this->belongsTo(SubCourse::class, 'id_submapel');
    }

    // Relasi dengan tabel sub_class
    public function subkelas()
    {
        return $this->belongsTo(SubClass::class, 'id_subkelas');
    }

    // Relasi dengan tabel sub_klasifikasi
    public function subklasifikasi()
    {
        return $this->belongsTo(SubClasification::class, 'id_subklasifikasi');
    }

    // Relasi dengan tabel sub_klasifikasi
    public function subklasifikasith()
    {
        return $this->belongsTo(SubClasificationTh::class, 'id_subklasifikasith');
    }
}
