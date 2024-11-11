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
                        'kelas'];
                        

    public function peminjamanBukuPaket()
        {
            return $this->hasMany(PeminjamanBukuPaket::class, 'id_siswa');
        }
}
