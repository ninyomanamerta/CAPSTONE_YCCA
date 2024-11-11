<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjamanBukuPaket extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman_buku_paket';

    protected $fillable = [
        'id_pinjam',
        'id_buku_paket',
        'status_peminjaman',
    ];


    public function peminjamanBukuPaket()
    {
        return $this->belongsTo(PeminjamanBukuPaket::class, 'id_pinjam');
    }

    public function bukuPaket()
    {
        return $this->belongsTo(DetailPackageBook::class, 'id_buku_paket');
    }
}
