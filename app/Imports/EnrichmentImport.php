<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\EnrichmentBook;
use App\Models\detailenrichmentbook;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;

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
        $this->lastNomorInduk = 0;
    }

    public function model(array $row)
    {
        //dd($row);
        $this->count++;

        if ($this->count === 1) {
            return null;
        }

        $tanggalMasuk = Date::excelToDateTimeObject($row[1])->format('Y-m-d');



        $enrichmentBookId = DB::table('enrichment_book')->insertGetId([
            'tgl_masuk' => $tanggalMasuk,
            'kategori' => $row[2],
            'judul' => $row[3], // pastikan ini bukan null atau kosong
            'tahun' => $row[4],
            'pengarang' => $row[5],
            'penerbit' => $row[6],
            'eksemplar' => $row[7],
            'id_rak' => $row[8],
            'id_jenis' => $row[9],
            'id_mapel' => $row[10],
            'id_submapel' => $row[11] ?? null,
            'id_subkelas' => $row[12] ?? null,
            'id_subklasifikasi' => $row[13] ?? null,
            'id_subklasifikasith' => $row[14] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        for ($i = 0; $i < $row[7]; $i++) {
            $this->lastNomorInduk++;

            DetailEnrichmentBook::create([
                'id_pengayaan' => $enrichmentBookId,
                'status_peminjaman' => 'available',
                'no_induk' => $this->lastNomorInduk,
            ]);
        }

    }


}
