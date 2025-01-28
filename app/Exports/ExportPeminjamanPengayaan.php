<?php
namespace App\Exports;

use App\Models\peminjaman_buku_pengayaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ExportPeminjamanPengayaan implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
     * Mengambil data peminjaman buku pengayaan
     */
    public function collection()
    {

        return peminjaman_buku_pengayaan::with([
                'student',
                'detailenrichmentbook.toEnrichmentBook',  
            ])
            ->get();
    }

    /**
     * Menentukan format setiap baris dalam file Excel
     */
    public function map($peminjaman): array
    {
        $rows = [];


        $formattedDatePinjam = Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y');

        $formattedDateKembali = $peminjaman->tgl_pengembalian
            ? Carbon::parse($peminjaman->tgl_pengembalian)->format('d-m-Y')
            : '-';

        $status = $peminjaman->status === 'dipinjam'
            ? 'Dipinjam'
            : ($peminjaman->status === 'dikembalikan' ? 'Dikembalikan' : 'Telat Pengembalian');

        $keterangan = $peminjaman->keterangan === 'Ganti baru' ? 'Ganti Baru' : '-';



        $detailBuku = $peminjaman->detailenrichmentbook;
        //dd($detailBuku);
        $enrichmentBook = $detailBuku->toEnrichmentBook;
        //dd($enrichmentBook);
        $judulBuku = $enrichmentBook->judul;
        $formattedNomorInduk = str_pad($detailBuku->no_induk, 4, '0', STR_PAD_LEFT);
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

        $this->rowNumber++;

        $rows[] = [
            $this->rowNumber,
            $formattedDatePinjam,
            $formattedDateKembali,
            $peminjaman->student->nis,
            $peminjaman->student->nama_siswa,
            $judulBuku,
            $status,
            $keterangan,
            $combinedKey,
        ];

        return $rows;
        dd($rows);
    }

    /**
     * Menentukan header kolom dalam file Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Pinjam',
            'Batas Pengembalian',
            'NIS',
            'Nama Siswa',
            'Judul Buku',
            'Status Peminjaman',
            'Keterangan',
            'Nomor Induk'
        ];
    }
}
