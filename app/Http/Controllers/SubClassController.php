<?php

namespace App\Http\Controllers;

use App\Models\SubClass;
use Illuminate\Http\Request;

class SubClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = SubClass::all();
        return view('klasifikasi.subkelas', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addsubkelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subkelas' => 'required|string',
            'noinduk' => 'required|string',
        ]);

        SubClass::create([
            'sub_kelas' => $request->subkelas,
            'nomor_induk_subkelas' => $request->noinduk,
        ]);

        return redirect()->route('class.index')->with('success', 'Sub Klasifikasi II berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = SubClass::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = SubClass::findOrFail($id);
        return view('klasifikasi.updateform.editsubkelas', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $class = SubClass::findOrFail($id);

        $request->validate([
            'subkelas' => 'required|string|max:255',
            'noinduk' => 'required|string|max:4',
        ]);

        $class->update([
            'sub_kelas' => $request->subkelas,
            'nomor_induk_subkelas' => $request->noinduk,
        ]);

        return redirect()->route('class.index')->with('success', 'Data sub klasifikasi II berhasil di update!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = SubClass::findOrFail($id);
        $class->delete();

        return redirect()->route('class.index')->with('success', 'Data sub klasifikasi II berhasil dihapus!');
    }
}
