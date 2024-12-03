<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetailStudents extends Model
{
    use HasFactory;

    protected $table = 'detail_students';

    protected $fillable = [
        'id_siswa',
        'tingkat',
        'kelas',
        'current_class',
    ];

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }
}
