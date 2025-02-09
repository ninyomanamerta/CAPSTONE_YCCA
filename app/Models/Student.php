<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
                        'nis',
                        'nama_siswa',
                        ];


        public function peminjamanBukuPaket()
        {
            return $this->hasMany(PeminjamanBukuPaket::class, 'id_siswa');
        }

        public function peminjamanBukuPengayaan()
        {
            return $this->hasMany(peminjaman_buku_pengayaan::class, 'id_siswa', 'id');
        }

        public function deleteStudent()
        {
            return $this->hasMany(DetailStudents::class, 'id_siswa', 'id');
        }

        protected static function boot()
        {
            parent::boot();

            static::deleting(function ($student) {
                $student->peminjamanBukuPaket()->delete();
                $student->peminjamanBukuPengayaan()->delete();
                $student->deleteStudent()->delete();
            });
        }

        public function detailSiswa()
        {
            return $this->hasMany(DetailStudents::class, 'id_siswa');
        }

}
