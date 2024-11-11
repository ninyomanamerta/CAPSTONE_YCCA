<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBukuPaket extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_buku_paket';

    protected $fillable = [
        'id_siswa',
        'penanggung_jawab',
    ];


    public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }

    public function detailPeminjamanBukuPaket()
    {
        return $this->hasMany(DetailPeminjamanBukuPaket::class, 'id_pinjam');
    }


}
