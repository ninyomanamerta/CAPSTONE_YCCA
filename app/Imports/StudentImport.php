<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Student;
use App\Models\DetailStudents;

class StudentImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        // dd($row);

        if (!isset($row['nis']) || empty($row['nis'])) {
            return null;
        }

        $student = Student::where('nis', $row['nis'])->first();

        if (!$student) {
            $student = new Student([
                'nis' => $row['nis'],
                'nama_siswa' => $row['nama_siswa'],
            ]);
            $student->save();
        }

        DetailStudents::where('id_siswa', $student->id)
            ->update(['current_class' => false]);

        return new DetailStudents([
            'id_siswa' => $student->id,
            'tingkat' => $row['tingkat'],
            'kelas' => $row['kelas'],
            'current_class' => true,
        ]);
    }
}
