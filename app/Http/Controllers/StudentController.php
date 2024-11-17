<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
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
        $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis',
            'namasiswa' => 'required|string|max:300',
            'kelas' => 'required|string|max:4',
        ]);

        Student::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->namasiswa,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('student.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('siswa.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis,' . $student->id,
            'namasiswa' => 'required|string|max:300',
            'kelas' => 'required|string|max:10',
        ]);

        $student->update([
            'nis' => $request->nis,
            'nama_siswa' => $request->namasiswa,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('student.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
