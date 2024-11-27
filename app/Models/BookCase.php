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

                        public function enrichmentBooks()
                        {
                            return $this->hasMany(enrichmentbook::class, 'id_rak');
                        }

                        protected static function boot()
                        {
                            parent::boot();

                            static::deleting(function ($bookcase) {

                                foreach ($bookcase->enrichmentBooks as $book) {
                                    foreach ($book->detailEnrichmentBooks as $detail) {
                                        $detail->borrowedEnrichmentBooks()->delete();
                                    }
                                    $book->detailEnrichmentBooks()->delete();
                                }
                                $bookcase->enrichmentBooks()->delete(); 
                            });
                        }
}
