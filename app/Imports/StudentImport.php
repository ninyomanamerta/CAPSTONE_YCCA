<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Student;
use App\Models\DetailStudents;


class StudentImport implements ToCollection, Tomodel
{
    private $count = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

    }

    public function model(array $row)
    {
        $this->count++;

        if ($this->count > 1) {
            $student = Student::where('nis', $row[1])->first();

            if (!$student) {
                $student = new Student;
                $student->nis = $row[1];
                $student->nama_siswa = $row[2];
                $student->save();
            }

            DetailStudents::where('id_siswa', $student->id)
                ->update(['current_class' => false]);

            $detail = new DetailStudents;
            $detail->tingkat = $row[3];
            $detail->kelas = $row[4];
            $detail->id_siswa = $student->id;
            $detail->save();
        }


    }
}
