<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\EnrichmentBook;
use App\Models\detailenrichmentbook;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EnrichmentImport implements ToCollection, Tomodel
{
    private $count = 0;
    private $lastNomorInduk;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function __construct()
    {
        $this->lastNomorInduk = detailenrichmentbook::max('no_induk') ?: 0;
    }

    public function model(array $row)
    {
        $this->count++;

        if ($this->count === 1) {
            return null;
        }

        $tanggalMasuk = Date::excelToDateTimeObject($row[1])->format('Y-m-d');


        $enrichmentBook = EnrichmentBook::create([
            'tgl_masuk' => $tanggalMasuk,
            'kategori' => $row[2],
            'judul' => $row[3],
            'pengarang' => $row[4],
            'penerbit' => $row[5],
            'tahun' => $row[6],
            'eksemplar' => $row[7],
            'id_rak' => $row[8],
        ]);

        for ($i = 0; $i < $row[7]; $i++) {
            $this->lastNomorInduk++;

            DetailEnrichmentBook::create([
                'id_pengayaan' => $enrichmentBook->id,
                'status_peminjaman' => 'available',
                'no_induk' => $this->lastNomorInduk,
            ]);
        }

    }


}
