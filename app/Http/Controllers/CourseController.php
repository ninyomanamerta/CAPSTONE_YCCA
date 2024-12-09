<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return view('klasifikasi.mapel', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addmapel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'mapel' => 'required|string',
            'noinduk' => 'required|string',
        ]);

        Course::create([
            'mapel' => $request->mapel,
            'nomor_induk_mapel' => $request->noinduk,
        ]);

        return redirect()->route('course.index')->with('success', 'Mapel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Course::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('klasifikasi.updateform.editmapel', compact('course'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'mapel' => 'required|string|max:255',
            'noinduk' => 'required|string|max:4',
        ]);

        $course->update([
            'mapel' => $request->mapel,
            'nomor_induk_mapel' => $request->noinduk,
        ]);

        return redirect()->route('course.index')->with('success', 'Data mapel berhasil di update!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('course.index')->with('success', 'Data mapel berhasil dihapus!');
    }
}
