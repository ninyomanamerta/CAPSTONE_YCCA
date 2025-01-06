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
        'id_siswa', 'id_judul_buku', 'id_detail_buku', 'peminjam', 'tgl_pinjam', 'tgl_pengembalian','status', 'keterangan'
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

    public function enrichmentBook()
    {
        return $this->hasOneThrough(
            enrichmentbook::class,
            detailenrichmentbook::class,
            'id',           // Foreign key di detailenrichmentbook
            'id',           // Foreign key di enrichmentbook
            'id_detail_buku', // Local key di peminjaman_buku_pengayaan
            'id_pengayaan'  // Local key di detailenrichmentbook
        );
    }

    // Relasi ke klasifikasi jenis
    public function jenis()
    {
        return $this->hasOneThrough(
            BookType::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_jenis'
        );
    }

    // Relasi ke klasifikasi mapel
    public function mapel()
    {
        return $this->hasOneThrough(
            Course::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_mapel'
        );
    }

    // Relasi ke klasifikasi submapel
    public function submapel()
    {
        return $this->hasOneThrough(
            SubCourse::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_submapel'
        );
    }

    // Relasi ke klasifikasi subkelas
    public function subkelas()
    {
        return $this->hasOneThrough(
            SubClass::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_subkelas'
        );
    }

    // Relasi ke klasifikasi subklasifikasi
    public function subklasifikasi()
    {
        return $this->hasOneThrough(
            SubClasification::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_subklasifikasi'
        );
    }

    // Relasi ke klasifikasi subklasifikasith
    public function subklasifikasith()
    {
        return $this->hasOneThrough(
            SubClasificationTh::class,
            enrichmentbook::class,
            'id',
            'id',
            'id_judul_buku',
            'id_subklasifikasith'
        );
    }

}

