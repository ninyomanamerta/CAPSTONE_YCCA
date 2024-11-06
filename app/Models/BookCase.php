<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCase extends Model
{
    use HasFactory;
    protected $table = 'bookcases';
    protected $fillable = [
                        'lokasi',
                        'keterangan'];
}
