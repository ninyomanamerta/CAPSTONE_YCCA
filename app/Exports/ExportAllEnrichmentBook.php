<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\EnrichmentBook;
use App\Models\detailenrichmentbook;
use Carbon\Carbon;

class ExportAllEnrichmentBook implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EnrichmentBook::with(['bookcase','jenis', 'mapel', 'submapel', 'subkelas', 'detailEnrichmentBooks', 'subklasifikasi', 'subklasifikasith'])
            ->get();
    }

    public function map($enrichmentBook): array
    {
        $rows = [];

        foreach ($enrichmentBook->detailEnrichmentBooks as $detail) {
                $formattedNomorInduk = str_pad($detail->no_induk, 4, '0', STR_PAD_LEFT);
                $combinedKey =
                    " " .
                    strval($enrichmentBook->jenis->nomor_induk_jenis) .
                    strval($enrichmentBook->mapel->nomor_induk_mapel) .
                    strval(optional($enrichmentBook->submapel)->nomor_induk_submapel) .
                    strval(optional($enrichmentBook->subkelas)->nomor_induk_subkelas) .
                    strval(optional($enrichmentBook->subklasifikasi)->nomor_induk_klasifikasi) .
                    strval(optional($enrichmentBook->subklasifikasith)->nomor_induk_klasifikasi4) .
                    '.' .
                    $formattedNomorInduk;

                $formattedDate = Carbon::parse($detail->tgl_masuk)->format('d-m-Y');

                $status = $detail->status_peminjaman === 'damaged'
                ? 'Buku Rusak'
                : 'Kondisi Baik';

                $jenis = $enrichmentBook->jenis->jenis_buku;

                $this->rowNumber++;

                $rows[] = [
                    $this->rowNumber,
                    $formattedDate,
                    $jenis,
                    $enrichmentBook->kategori,
                    $enrichmentBook->judul,
                    $enrichmentBook->tahun,
                    $enrichmentBook->penerbit,
                    $enrichmentBook->pengarang,
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
            'Kategori Buku',
            'Judul',
            'Tahun Terbit',
            'Penerbit',
            'Pengarang',
            'Nomor Induk',
            'Kondisi Buku',
        ];
    }
}
