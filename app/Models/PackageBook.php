<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBook extends Model
{
    use HasFactory;

    protected $table = 'package_books';

    protected $fillable = [
        'tgl_masuk',
        'judul',
        'tahun_terbit',
        'penerbit',
        'eksemplar',
        'sumber',
        'id_jenis',
        'id_mapel',
        'id_submapel',
        'id_subkelas',
        'id_subklasifikasi',
        'id_subklasifikasith',
    ];

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

    public function detailPackageBooks()
    {
        return $this->hasMany(DetailPackageBook::class, 'id_package_books');
    }
}
