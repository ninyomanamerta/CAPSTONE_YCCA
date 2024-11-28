<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_buku_pengayaan extends Model
{
    use HasFactory;

    // Specify the table name if different
    protected $table = 'peminjaman_buku_pengayaan';
    
    // Define fillable attributes if needed
    protected $fillable = [
        'id_siswa', 'id_judul_buku', 'id_detail_buku', 'peminjam', 'tgl_pinjam', 'tgl_pengembalian','status'
    ];

    /**
     * Relationship with Student model.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'id_siswa', 'id'); // Assuming id_siswa is the foreign key and id is the primary key in students table.
    }

    /**
     * Relationship with EnrichmentBook model.
     */
    public function book()
    {
        return $this->belongsTo(enrichmentbook::class, 'id_judul_buku', 'id'); // Assuming id_judul_buku is the foreign key in enrichmentbook table.
    }

    /**
     * Relationship with detailenrichmentbook model.
     */
    public function detailenrichmentbook()
    {
        return $this->belongsTo(detailenrichmentbook::class, 'id_detail_buku', 'id'); // Assuming id_detail_buku is the foreign key in detailenrichmentbook table.
    }

}

