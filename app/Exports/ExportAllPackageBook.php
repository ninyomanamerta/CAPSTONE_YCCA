<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use Carbon\Carbon;

class ExportAllPackageBook implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PackageBook::with(['jenis', 'mapel', 'submapel', 'subkelas', 'detailPackageBooks', 'subklasifikasi', 'subklasifikasith'])
            ->get();
    }

    public function map($packageBook): array
    {
        $rows = [];

        foreach ($packageBook->detailPackageBooks as $detail) {

                $formattedNomorInduk = str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT);
                $combinedKey =
                    " " .
                    strval($packageBook->jenis->nomor_induk_jenis) .
                    strval($packageBook->mapel->nomor_induk_mapel) .
                    strval(optional($packageBook->submapel)->nomor_induk_submapel) .
                    strval(optional($packageBook->subkelas)->nomor_induk_subkelas) .
                    strval(optional($packageBook->subklasifikasi)->nomor_induk_klasifikasi) .
                    strval(optional($packageBook->subklasifikasith)->nomor_induk_klasifikasi4) .
                    '.' .
                    $formattedNomorInduk;

                $formattedDate = Carbon::parse($detail->tgl_masuk)->format('d-m-Y');

                $status = $detail->status_peminjaman === 'damaged'
                ? 'Buku Rusak'
                : 'Kondisi Baik';

                $jenis = $packageBook->jenis->jenis_buku;

                $this->rowNumber++;

                $rows[] = [
                    $this->rowNumber,
                    $formattedDate,
                    $jenis,
                    $packageBook->judul,
                    $packageBook->tahun_terbit,
                    $packageBook->penerbit,
                    $packageBook->sumber,
                    $combinedKey,
                    $status,
                ];

        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Masuk',
            'Jenis Buku',
            'Judul',
            'Tahun Terbit',
            'Penerbit',
            'Sumber',
            'Nomor Induk',
            'Kondisi Buku',
        ];
    }
}
