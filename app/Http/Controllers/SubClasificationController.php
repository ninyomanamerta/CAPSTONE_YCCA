<?php

namespace App\Http\Controllers;

use App\Models\SubClasification;
use Illuminate\Http\Request;

class SubClasificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = SubClasification::all();
        return view('klasifikasi.clasification', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addclasification');
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

        SubClasification::create([
            'klasifikasi' => $request->subkelas,
            'nomor_induk_klasifikasi' => $request->noinduk,
        ]);

        return redirect()->route('klasifikasi.index')->with('success', 'Sub Klasifikasi III berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = SubClasification::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = SubClasification::findOrFail($id);
        return view('klasifikasi.updateform.editclasification', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $class = SubClasification::findOrFail($id);

        $request->validate([
            'subkelas' => 'required|string|max:255',
            'noinduk' => 'required|string|max:4',
        ]);

        $class->update([
            'klasifikasi' => $request->subkelas,
            'nomor_induk_klasifikasi' => $request->noinduk,
        ]);

        return redirect()->route('klasifikasi.index')->with('success', 'Data sub klasifikasi III berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = SubClasification::findOrFail($id);
        $class->delete();

        return redirect()->route('klasifikasi.index')->with('success', 'Data sub klasifikasi III berhasil dihapus!');
    }
}
