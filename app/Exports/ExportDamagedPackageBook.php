<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use Carbon\Carbon;

class ExportDamagedPackageBook implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PackageBook::with(['jenis', 'mapel', 'submapel', 'subkelas', 'detailPackageBooks'])
            ->whereHas('detailPackageBooks', function ($query) {
                $query->where('status_peminjaman', 'damaged');
            })
            ->get();
    }

    public function map($packageBook): array
    {
        $rows = [];

        foreach ($packageBook->detailPackageBooks as $detail) {
            if ($detail->status_peminjaman === 'damaged') {
                $formattedNomorInduk = str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT);
                $combinedKey =
                    strval($packageBook->jenis->nomor_induk_jenis) .
                    strval($packageBook->mapel->nomor_induk_mapel) .
                    strval($packageBook->submapel->nomor_induk_submapel) .
                    strval($packageBook->subkelas->nomor_induk_subkelas) .
                    '.' .
                    $formattedNomorInduk;

                $formattedDate = Carbon::parse($packageBook->tgl_masuk)->format('d-m-Y');

                $this->rowNumber++;

                $rows[] = [
                    $this->rowNumber,
                    $formattedDate,
                    $packageBook->judul,
                    $packageBook->tahun_terbit,
                    $packageBook->penerbit,
                    $packageBook->eksemplar,
                    $packageBook->sumber,
                    $combinedKey,
                    'Buku Rusak',
                ];
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Masuk',
            'Judul',
            'Tahun Terbit',
            'Penerbit',
            'Eksemplar',
            'Sumber',
            'Nomor Induk',
            'Status',
        ];
    }
}
