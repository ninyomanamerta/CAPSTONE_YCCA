<?php

namespace App\Http\Controllers;

use App\Models\SubClasificationTh;
use Illuminate\Http\Request;

class SubClasificationThController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = SubClasificationTh::all();
        return view('klasifikasi.clasificationth', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addclasificationth');
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

        SubClasificationTh::create([
            'klasifikasi4' => $request->subkelas,
            'nomor_induk_klasifikasi4' => $request->noinduk,
        ]);

        return redirect()->route('klasifikasiTh.index')->with('success', 'Sub Klasifikasi IV berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = SubClasificationTh::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = SubClasificationTh::findOrFail($id);
        return view('klasifikasi.updateform.editclasificationth', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $class = SubClasificationTh::findOrFail($id);

        $request->validate([
            'subkelas' => 'required|string|max:255',
            'noinduk' => 'required|string|max:4',
        ]);

        $class->update([
            'klasifikasi4' => $request->subkelas,
            'nomor_induk_klasifikasi4' => $request->noinduk,
        ]);

        return redirect()->route('klasifikasiTh.index')->with('success', 'Data sub klasifikasi IV berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = SubClasificationTh::findOrFail($id);
        $class->delete();

        return redirect()->route('klasifikasiTh.index')->with('success', 'Data sub klasifikasi IV berhasil dihapus!');
    }
}
