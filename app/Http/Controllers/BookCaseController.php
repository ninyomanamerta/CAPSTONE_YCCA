<?php

namespace App\Http\Controllers;

use App\Models\BookCase;
use Illuminate\Http\Request;

class BookCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rak = BookCase::all();
        return view('rak.index', compact('rak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string|max:20|unique:bookcases,lokasi',
            'keterangan' => 'required|string|max:65',
        ]);

        BookCase::create([
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = BookCase::findOrFail($id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rak = BookCase::findOrFail($id);
        return view('rak.edit', compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rak = BookCase::findOrFail($id);

        $request->validate([
            'lokasi' => 'required|string|max:20|unique:bookcases,lokasi,' . $rak->id,
            'keterangan' => 'required|string|max:65',
        ]);

        $rak->update([
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil di edit!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rak = BookCase::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil dihapus!');
    }
}
