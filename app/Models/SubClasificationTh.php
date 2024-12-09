<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClasificationTh extends Model
{
    use HasFactory;
    protected $table = 'sub_clasification4';
    protected $fillable = [
                        'klasifikasi4',
                        'nomor_induk_klasifikasi4'];
}
