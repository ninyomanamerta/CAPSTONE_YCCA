<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
     * Mengambil data siswa dari database
     */
    public function collection()
    {
        return Student::with(['detailSiswa'])->get();
    }

    /**
     * Menentukan format setiap baris dalam file Excel
     */
    public function map($student): array
    {
        $rows = [];

        foreach ($student->detailSiswa as $detail) {
            $this->rowNumber++;

            $rows[] = [
                $this->rowNumber,
                Carbon::parse($detail->created_at)->format('d-m-Y'),
                $student->nis,
                $student->nama_siswa,
                $detail->tingkat,
                $detail->kelas,
                $detail->current_class ? 'Ya' : 'Tidak',
            ];
        }

        return $rows;
    }

    /**
     * Menentukan header kolom dalam file Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Dibuat',
            'NIS',
            'Nama Siswa',
            'Tingkat',
            'Kelas',
            'Kelas Sekarang',
        ];
    }
}
