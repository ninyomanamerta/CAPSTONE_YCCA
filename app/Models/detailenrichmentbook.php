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
        'judul',
        'no_induk'
    ];

    /**
     * Relasi dengan model EnrichmentBook.
     * Setiap DetailEnrichmentBook berhubungan dengan satu EnrichmentBook.
     */
    public function enrichmentBook()
    {
        return $this->belongsTo(EnrichmentBook::class, 'id_pengayaan');
    }
}
