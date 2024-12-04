<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\DetailStudents;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Excel;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('detailSiswa')->get();
        // dd($students);
        return view('siswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255',
            'namasiswa' => 'required|string|max:255',
            'tingkat' => 'required|integer',
            'kelas' => 'required|string|max:2',
        ]);

        DB::beginTransaction();

        try {
            $student = Student::where('nis', $validated['nis'])->first();

            if (!$student) {

                $student = Student::create([
                    'nis' => $validated['nis'],
                    'nama_siswa' => $validated['namasiswa'],
                ]);
            }

            DetailStudents::where('id_siswa', $student->id)->update(['current_class' => false]);

            DetailStudents::create([
                'id_siswa' => $student->id,
                'tingkat' => $validated['tingkat'],
                'kelas' => $validated['kelas'],
                'current_class' => true,
            ]);

            DB::commit();

            return redirect()->route('student.index')->with('success', 'Data siswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data siswa: ' . $e->getMessage()])
                ->withInput();
        }


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('detailSiswa')->findOrFail($id);

        return response()->json([
            'nis' => $student->nis,
            'nama_siswa' => $student->nama_siswa,
            'kelas' => $student->detailSiswa->map(function ($detail) {
                return [
                    'tingkat' => $detail->tingkat,
                    'kelas' => $detail->kelas,
                    'current_class' => $detail->current_class ? 'Yes' : 'No',
                ];
            }),
            'created_at' => $student->created_at
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with('detailSiswa')->findOrFail($id);
        return view('siswa.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis,' . $student->id,
            'namasiswa' => 'required|string|max:255',
            'tingkat' => 'required|array',
            'kelas' => 'required|array',
            'current_class' => 'nullable|array',
        ]);



        $student->nis = $request->nis;
        $student->nama_siswa = $request->namasiswa;
        $student->save();

        $currentClassIds = $request->current_class ?? [];

        foreach ($request->tingkat as $key => $tingkat) {
            $detail = DetailStudents::where('id_siswa', $student->id)
                ->where('id', $request->detail_ids[$key] ?? null)
                ->first();

            if ($detail) {
                $detail->tingkat = $tingkat;
                $detail->kelas = $request->kelas[$key];

                if (in_array($detail->id, $currentClassIds)) {
                    $detail->current_class = true;
                } else if ($currentClassIds) {
                    $detail->current_class = false;
                }

                $detail->save();
            }
        }


        return redirect()->route('student.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        // Hapus data terkait di kedua tabel
        $student->peminjamanBukuPaket()->delete();
        $student->peminjamanBukuPengayaan()->delete();
        $student->deleteStudent()->delete();

        // Hapus data siswa
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Data siswa beserta peminjaman berhasil dihapus!');
    }

    public function import()
    {
        return view('siswa.import');
    }

    public function proses(Request $request)
    {
        // $file = $request->file('students');

        // // Validasi file
        // $request->validate([
        //     'file' => 'required|mimes:xlsx',
        // ]);

        // Excel::import(new StudentImport, $file);


        Excel::import(new StudentImport, $request->file('students'));

        return redirect()->route('student.index')->with('success', 'Data siswa berhasil ditambahkan!');

    }





}
