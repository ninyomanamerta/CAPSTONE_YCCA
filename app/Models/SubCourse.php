<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{
    use HasFactory;
    protected $table = 'sub_courses';
    protected $fillable = [
                        'sub_mapel',
                        'nomor_induk_mapel'];
}
