<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory;
    protected $table = 'type_books';
    protected $fillable = [
                        'jenis_buku',
                        'nomor_induk_jenis'];
}
