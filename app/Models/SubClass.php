<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClass extends Model
{
    use HasFactory;
    protected $table = 'sub_class';
    protected $fillable = [
                        'sub_kelas',
                        'nomor_induk_subkelas'];
}
