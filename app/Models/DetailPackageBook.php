<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPackageBook extends Model
{
    use HasFactory;

    protected $table = 'detail_package_books';

    protected $fillable = [
        'id_package_books',
        'nomor_induk',
        'status_peminjaman',
    ];

    // Relasi dengan tabel package_books (satu detail_package_book memiliki satu package_book)
    public function packageBook()
    {
        return $this->belongsTo(PackageBook::class, 'id_package_books');
    }
}
