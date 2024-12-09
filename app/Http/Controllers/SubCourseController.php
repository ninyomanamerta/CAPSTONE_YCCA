<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use Illuminate\Http\Request;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subCourse = SubCourse::all();
        return view('klasifikasi.submapel', compact('subCourse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addsubmapel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'submapel' => 'required|string',
            'noinduk' => 'nullable|string',
        ]);

        SubCourse::create([
            'sub_mapel' => $request->submapel,
            'nomor_induk_submapel' => $request->noinduk,
        ]);

        return redirect()->route('subCourse.index')->with('success', 'Sub Klasifikasi I berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = SubCourse::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subCourse = SubCourse::findOrFail($id);
        return view('klasifikasi.updateform.editsubmapel', compact('subCourse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subCourse = SubCourse::findOrFail($id);

        $request->validate([
            'submapel' => 'required|string|max:255',
            'noinduk' => 'required|string|max:4',
        ]);

        $subCourse->update([
            'sub_mapel' => $request->submapel,
            'nomor_induk_submapel' => $request->noinduk,
        ]);

        return redirect()->route('subCourse.index')->with('success', 'Data sub klasifikasi I berhasil di update!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subCourse = SubCourse::findOrFail($id);
        $subCourse->delete();

        return redirect()->route('subCourse.index')->with('success', 'Data sub klasifikasi I berhasil dihapus!');
    }
}
