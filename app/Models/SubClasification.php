<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClasification extends Model
{
    use HasFactory;
    protected $table = 'sub_clasification';
    protected $fillable = [
                        'klasifikasi',
                        'nomor_induk_klasifikasi'];
}
