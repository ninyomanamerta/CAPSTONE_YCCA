<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailenrichmentbook extends Model
{
    use HasFactory;
    protected $table = 'detail_enrichment_book';

    protected $fillable = [
        'id_pengayaan',
        'status_peminjaman',
        'no_induk'
    ];

    /**
     * Relasi dengan model EnrichmentBook.
     * Setiap DetailEnrichmentBook berhubungan dengan satu EnrichmentBook.
     */
    public function enrichmentBook()
    {
        return $this->belongsTo(detailenrichmentbook::class, 'id_pengayaan');
    }

    public function bookcase()
    {
        return $this->belongsTo(Bookcase::class, 'id_rak');
    }

    public function borrowedEnrichmentBooks()
    {
        return $this->hasMany(peminjaman_buku_pengayaan::class, 'id_detail_buku');
    }


}
