<?php

namespace App\Exports;

use App\Models\PeminjamanBukuPaket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ExportPeminjamanPaket implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
    * Ambil data peminjaman buku paket
    */
    public function collection()
{
    return PeminjamanBukuPaket::with(['detailPeminjamanBukuPaket.bukuPaket.packageBook', 'siswa'])
        ->get()
        ->sortBy(function($peminjaman) {
            // Urutkan berdasarkan kelas (angka dan huruf)
            $kelas = $peminjaman->kelas;
            preg_match('/(\d+)([A-Za-z]+)/', $kelas, $matches);
            $angka = $matches[1] ?? 0;
            $huruf = $matches[2] ?? '';

            // Urutkan dengan angka dulu, kemudian huruf
            return [$angka, $huruf, $peminjaman->siswa->nis]; // urutkan berdasarkan NIS juga
        });
}

    /**
    * Mapping untuk data export
    */
    public function map($peminjaman): array
    {
        $rows = [];

        foreach ($peminjaman->detailPeminjamanBukuPaket as $detail) {
            $packageBook = $detail->bukuPaket->packageBook;
            $student = $peminjaman->siswa;

            $formattedNomorInduk = str_pad($detail->bukuPaket->nomor_induk, 4, '0', STR_PAD_LEFT);

            $combinedKey =
                strval(optional($packageBook->jenis)->nomor_induk_jenis) .
                strval(optional($packageBook->mapel)->nomor_induk_mapel) .
                strval(optional($packageBook->submapel)->nomor_induk_submapel) .
                strval(optional($packageBook->subkelas)->nomor_induk_subkelas) .
                strval(optional($packageBook->subklasifikasi)->nomor_induk_klasifikasi) .
                strval(optional($packageBook->subklasifikasith)->nomor_induk_klasifikasi4) .
                '.' .
                $formattedNomorInduk;

            // Tanggal peminjaman
            $tanggalPeminjaman = Carbon::parse($detail->tanggal_pinjam)->format('d-m-Y');

            // Status Keterangan: borrowed, returned, ganti baru, atau -
            $status = $detail->status_peminjaman === 'borrowed' ? 'Dipinjam' :
                      ($detail->status_peminjaman === 'returned' ? 'Dikembalikan' :
                      ($detail->status_peminjaman === null ? '-' : 'Ganti Baru'));

            // Tanggal Pengembalian hanya jika status returned, jika tidak set "-"
            $tanggalPengembalian = $detail->status_peminjaman === 'returned'
                ? Carbon::parse($detail->updated_at)->format('d-m-Y')
                : '-';

            $kelas = $peminjaman->kelas;
            $pj = $peminjaman->penanggung_jawab;
            $pj_pengembalian = $peminjaman->pengembalian;

            $this->rowNumber++;

            // Menambahkan row untuk setiap detail peminjaman buku
            $rows[] = [
                $this->rowNumber,
                $tanggalPeminjaman,
                $pj,
                $student->nis,
                $student->nama_siswa,
                $kelas,
                $packageBook->judul,
                $combinedKey,
                $status,
                $tanggalPengembalian,
                $pj_pengembalian,
            ];
        }

        return $rows;
    }

    /**
    * Headings untuk kolom di file Excel
    */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Peminjaman',
            'Penanggung Jawab Peminjaman',
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Judul Buku',
            'Nomor Induk',
            'Keterangan',
            'Tanggal Pengembalian',
            'Penanggung Jawab Pengembalian'
        ];
    }
}
