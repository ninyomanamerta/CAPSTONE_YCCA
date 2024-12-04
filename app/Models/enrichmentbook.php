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
        'id_rak'
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
}
